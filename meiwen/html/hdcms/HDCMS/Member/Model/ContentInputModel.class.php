<?php

/**
 * 添加数据时前期处理
 */
class ContentInputModel {
	//字段缓存
	private $field;
	//模型mid
	private $mid;
	//栏目cid
	private $cid;
	//栏目缓存
	private $category;
	//不需要处理的字段
	private $noDealField = array( 'aid', 'cid', 'mid', 'new_window', 'addtime' );

	/**
	 *
	 * 构造函数
	 *
	 * @param int $mid 模型mid
	 */
	public function __construct( $mid ) {
		$this->mid      = $mid;
		$this->cid      = Q( 'cid', 0, 'intval' );
		$this->field    = S( 'field' . $this->mid );
		$this->category = S( 'category' );
	}

	/**
	 * 获得入库数据
	 *
	 * @return array|bool
	 */
	public function get() {
		$data = &$_POST;
		//封面栏目与链接不允许发表
		if ( ! isset( $data['cid'] ) || ! isset( $this->category[ $data['cid'] ] ) ) {
			$this->error = '栏目不存在';

			return false;
		}
		//封面栏目与链接不允许发表
		if ( ! in_array( $this->category[ $data['cid'] ]['cattype'], array( 1, 4 ) ) ) {
			$this->error = '栏目选择错误';

			return false;
		}
		//添加文章时设置 作者uid
		if ( ! isset( $data['aid'] ) ) {
			$data['uid'] = $_SESSION['user']['uid'];
		}
		//添加文章时设置状态 0 待审核 1 发表 2 自动
		if ( ! isset( $_GET['aid'] ) ) {
			$data['content_status'] = $this->category[ $data['cid'] ]['member_send_status'];
		}
		//没有添加内容时初始设置
		if ( empty( $data['content'] ) ) {
			$data['content'] = '';
		}
		//添加时间
		if ( ! isset( $data['aid'] ) ) {
			$data['addtime'] = time();
		}
		//修改时间
		$data['updatetime'] = time();
		//阅读积分处理
		if ( ! empty( $data['readpoint'] ) && ! is_numeric( $data['readpoint'] ) ) {
			$data['readpoint'] = 0;
		}
		//文章模型
		$ContentModel = ContentModel::getInstance( $this->mid );

		//自动提取文章描述
		if ( empty( $data['description'] ) ) {
			$len                 = isset( $data['auto_desc_length'] ) ? $data['auto_desc_length'] : 200;
			$data['description'] = mb_substr( strip_tags( $data['content'] ), 0, $len, 'utf-8' );
		}
		foreach ( $this->field as $fieldInfo ) {
			//关闭前台投稿可字段禁用
			if ( $fieldInfo['status'] == 0 || $fieldInfo['isadd'] == 0 ) {
				continue;
			}
			//不需要处理的字段
			if ( in_array( $fieldInfo['field_name'], $this->noDealField ) ) {
				continue;
			}
			$field = $fieldInfo['field_name'];
			//字段set选项
			$set = $fieldInfo['set'];
			//字段二次处理方法
			$METHOD         = $fieldInfo['field_type'];
			$data[ $field ] = empty( $data[ $field ] ) ? '' : $data[ $field ];
			if ( method_exists( $this, $METHOD ) ) {
				$Value = $this->$METHOD( $fieldInfo, $data[ $field ] );
				if ( $fieldInfo['table_type'] == 1 ) { //主表数据
					$data[ $field ] = $Value;
				} else { //副表
					$data[ $fieldInfo['table_name'] ][ $field ] = $Value;
				}
			}

			//如果字段设置唯一性验证时执行验证操作
			if ( (int) $fieldInfo['isunique'] == 1 ) {
				if ( M( $fieldInfo['table_name'] )->where( $field . "='$Value'" )->find() ) {
					$this->error = $fieldInfo['title'] . '已经存在';
					return false;
				}
			}
			//模型自动验证规则设置
			$validateRule = array();
			//验证时机 1 有这个表单就验证  2 必须验证 3 表单不为空才验证
			$validateOccasion = (int) $fieldInfo['required'] ? 2 : 3;
			//设置验证规则
			if ( isset( $set['minlength'] ) && isset( $set['maxlength'] ) ) {
				$maxlength = (int) $set['maxlength'];
				$minlength = (int) $set['minlength'];
				if ( $maxlength > $minlength ) {
					$validateRule[] = array(
						$field, "minlen:$minlength", $fieldInfo['title'] . " 数量不能小于{$minlength}个字", $validateOccasion, 3
					);
					$validateRule[] = array(
						$field, "maxlen:$maxlength", $fieldInfo['title'] . " 数量不能大于{$maxlength}个字", $validateOccasion, 3
					);
				}
			}
			//验证规则
			if ( ! empty( $fieldInfo['validate'] ) ) {
				$regexp         = $fieldInfo['validate'];
				$error          = empty( $fieldInfo['error'] ) ? $fieldInfo['title'] . '输入错误' : $set['error'];
				$validateRule[] = array( $field, "regexp:$regexp", $error, $validateOccasion, 3 );
			}
			//必须输入验证
			if ( $fieldInfo['required'] == 1 ) {
				$validateRule[] = array( $field, "nonull", $fieldInfo['title'] . '不能为空', $validateOccasion, 3 );
			}
			//模型Validate属性设置验证规则
			if ( ! empty( $validateRule ) ) {
				foreach ( $validateRule as $validate ) {
					$ContentModel->addValidate( $validate );
				}
			}
		}
		//如果没有缩略图时，删除图片属性
		if ( isset( $data['flag'] ) ) {
			if ( empty( $data['thumb'] ) ) { //没有缩略图时，删除图片属性
				if ( false !== $k = array_search( '图片', $data['flag'] ) ) {
					unset( $data['flag'][ $k ] );
				}
			} else {
				$data['flag'][] = '图片';
			}
			$data['flag'] = implode( ',', array_unique( $data['flag'] ) );
		}

		return $data;
	}

	//标题字段
	private function title( $fieldInfo, $value ) {
		return htmlspecialchars( trim( $value ) );
	}

	//文章状态
	private function content_status( $fieldInfo, $value ) {
		return 1;
	}

	//缩略图
	private function thumb( $fieldInfo, $value ) {
		//更新图片状态
		if ( $value ) {
			$map['path']    = $value;
			$data['mid']    = $this->mid;
			$data['status'] = 1;
			M( 'upload' )->where( $map )->save( $data );
		}

		return $value;
	}

	//模板选择
	private function template( $fieldInfo, $value ) {
		return $value;
	}

	//栏目选择
	private function cid( $fieldInfo, $value ) {
		return (int) $value;
	}

	//文章内容
	private function content( $fieldInfo, $value ) {
		if ( empty( $value ) ) {
			return '';
		}
		return $value;
	}

	//Flag文章属性
	private function flag( $fieldInfo, $value ) {
		if ( empty( $value ) ) {
			$value = array();
		}
		$flagCache = S( 'flag' . $this->mid );
		$data      = array();
		foreach ( $value as $flag ) {
			if ( ! in_array( $flag, $flagCache ) ) {
				continue;
			}
			$data[] = $flag;
		}

		return $data;
	}

	//文本字段
	private function input( $fieldInfo, $value ) {
		return htmlspecialchars( trim( $value ) );
	}

	//多行文本
	private function textarea( $fieldInfo, $value ) {
		return htmlspecialchars( trim( $value ) );
	}

	//数字
	private function number( $fieldInfo, $value ) {
		$set        = $fieldInfo['set'];
		$field_type = isset( $set['field_type'] ) ? $set['field_type'] : 'int';
		switch ( $field_type ) {
			case "decimal" :
				return floatval( $value );
			default :
				return intval( $value );
		}
	}

	//选项
	private function box( $fieldInfo, $value ) {
		$set = $fieldInfo['set'];
		//checkbox连接成字符串，数据库中以字符串形式记录
		if ( $set['form_type'] == 'checkbox' && ! empty( $value ) ) {
			return implode( ',', $value );
		} else { //radio等类型
			return $value;
		}
	}

	//编辑器
	private function editor( $fieldInfo, $value ) {
		return $value;
	}

	//单图上传
	private function image( $fieldInfo, $value ) {
		if ( $value ) {
			$map['path']    = $value;
			$data['status'] = 1;
			M( 'upload' )->where( $map )->save( $data );
		}

		return $value;
	}

	//多图上传
	private function images( $fieldInfo, $value ) {
		if ( $value && isset( $value['path'] ) ) {
			foreach ( $value['path'] as $path ) {
				$map['path']    = $path;
				$data['status'] = 1;
				M( 'upload' )->where( $map )->save( $data );
			}
		}
		if ( ! empty( $value ) ) {
			$file = array();
			foreach ( $value['path'] as $id => $v ) {
				$tmp['path'] = $value['path'][ $id ];
				$tmp['alt']  = $value['alt'][ $id ];
				$file[]      = $tmp;
			}
			$value = serialize( $file );
		}

		return $value;
	}

	//文件上传
	private function files( $fieldInfo, $value ) {
		if ( $value && isset( $value['path'] ) ) {
			foreach ( $value['path'] as $path ) {
				$map['path']    = $path;
				$data['status'] = 1;
				M( 'upload' )->where( $map )->save( $data );
			}
		}
		if ( ! empty( $value ) ) {
			$file = array();
			foreach ( $value['path'] as $id => $v ) {
				$tmp['path'] = $value['path'][ $id ];
				$tmp['alt']  = $value['alt'][ $id ];
				$file[]      = $tmp;
			}
			$value = serialize( $file );
		}

		return $value;
	}

	//日期时间
	private function datetime( $fieldInfo, $value ) {
		if ( empty( $value ) ) {
			return time();
		} else {
			return strtotime( $value );
		}
	}
}