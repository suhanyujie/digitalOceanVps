<?php

/**
 * 模型字段管理
 * Class FieldController
 *
 * @author 后盾向军 <houdunwangxj@gmail.com>
 */
class FieldController extends AuthController {
	//模型mid
	private $mid;
	//模型缓存
	private $model;
	//字段缓存
	private $field;
	//模型
	private $db;

	//构造函数
	public function __init() {
		$this->mid   = Q( "mid", 0, "intval" );
		$this->model = S( "model" );
		$this->field = S( 'field' . $this->mid );
		$this->db    = K( 'Field' );
	}

	//字段列表
	public function index() {
		/**
		 * 不允许删除字段
		 */
		$this->assign( 'noallowdelete', FieldModel::$NoAllowDelete );
		/**
		 * 不允许删除字段
		 */
		$this->assign( 'noallowedit', FieldModel::$NoAllowEdit );
		/**
		 * 不允许禁用字段
		 */
		$this->assign( 'noallowforbidden', FieldModel::$NoAllowForbidden );
		/**
		 * 分配当前模型的字段数据
		 */
		$map['mid'] = array( 'IN', array( $this->mid ) );
		$field      = M( 'field' )->where( $map )->order( 'fieldsort ASC' )
		                          ->all();
		$this->assign( 'field', $field );
		$this->display();
	}

	/**
	 * 更新字段排序
	 */
	public function updateSort() {
		$orders = Q( "fieldsort" );
		foreach ( $orders as $k => $v ) {
			$this->db->save( array( "fid" => $k, "fieldsort" => $v ) );
		}
		if ( $this->db->updateCache() ) {
			$this->success( "排序成功" );
		} else {
			$this->error( '排序失败' );
		}
	}

	//添加字段
	public function add() {
		if ( IS_POST ) {
			$Model = FieldModel::getInstance();
			if ( $Model->addField() ) {
				$this->success( '添加字段成功' );
			} else {
				$this->error( $Model->error );
			}
		} else {
			$this->assign( 'model', $this->model[ $this->mid ] );
			$this->display();
		}
	}

	//修改字段
	public function edit() {
		if ( IS_POST ) {
			$Model = FieldModel::getInstance();
			if ( $Model->editField() ) {
				$this->success( '修改成功' );
			} else {
				$this->error( $Model->error );
			}
		} else {
			$fid   = Q( 'fid', 0, 'intval' );
			$data  = M( 'field' )->where( "fid=$fid" )->find();
			$field = $this->field[ $data['field_name'] ];
			$this->assign( 'field', $field );
			/**
			 * 字段set值模板
			 * 依赖上面分配的field值
			 */
			$setField = $this->fetch(
				CONTROLLER_VIEW_PATH . "Data/{$data['field_type']}/edit"
			);

			$this->assign( 'setField', $setField );
			$this->assign( 'model_name',
				$this->model[ $this->mid ]['model_name'] );
			$this->display();
		}
	}

	/**
	 * 选择字段类型模板
	 */
	public function getAddFieldTpl() {
		/**
		 * 执行动作
		 */
		$action = Q( "post.action" );
		/**
		 * 字段类型
		 */
		$field_type = Q( "post.field_type" );
		echo $this->fetch(
			CONTROLLER_VIEW_PATH . "Data/{$field_type}/{$action}"
		);
		exit;
	}

	/**
	 * 删除字段
	 */
	public function del() {
		$fid = Q( 'fid' );
		if ( $fid ) {
			if ( $this->db->delField() ) {
				$this->success( '字段删除成功' );
			} else {
				$this->error( $this->db->error );
			}
		} else {
			$this->error( $this->_db->error );
		}
	}

	/**
	 * 更新字段缓存
	 */
	public function updateCache() {
		if ( $this->db->updateCache() ) {
			$this->success( '更新成功' );
		} else {
			$this->error( $this->db->error );
		}
	}

	/**
	 * 禁用或开启字段
	 */
	public function forbidden() {
		$status = Q( 'status', 0, 'intval' );
		$fid    = Q( 'fid', 0, 'intval' );
		if ( M( 'field' )->save( array( 'fid'    => $fid,
		                                'status' => $status
		) )
		) {
			$this->db->updateCache();
			$this->success( '设置成功' );
		} else {
			$this->error( '设置失败' );
		}
	}
}
