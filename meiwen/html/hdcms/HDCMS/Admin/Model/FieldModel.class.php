<?php

/**
 * 模型字段管理
 * Class FieldModel
 *
 * @author 后盾向军 <2300071698@qq.com>
 */
class FieldModel extends Model {
	//表
	public $table = "field";
	//模型mid
	private $mid;
	//字段缓存
	private $field;
	//模型缓存
	private $model;
	//前台投稿不允许隐藏的字段
	static public $NoAllowHide = array( 'title', 'cid' );
	//不允许删除的字段
	static public $NoAllowDelete
		= array(
			'title',
			'cid',
			'addtime',
			'arc_sort',
			'readpoint',
			'content_status'
		);
	//不允许修改的字段
	static public $NoAllowEdit
		= array(
			'cid',
			'flag',
			'content',
			'tag',
			'template'
		);
	//不允许禁用的字段
	static public $NoAllowForbidden
		= array(
			'title',
			'cid',
			'addtime',
			'arc_sort',
			'readpoint',
			'content_status'
		);
	/**
	 * 自动验证
	 *
	 * @var array
	 */
	public $validate
		= array(
			array( 'title', 'nonull', '字段标题不能为空', 2, 3 ), //字段类型
			array( 'field_name', 'nonull', '字段名不能为空', 2, 1 ),//字段名
			array( 'field_name', 'hasField', '字段已经存在', 2, 1 ),//字段名
			array( 'field_type', 'nonull', '字段类型不能为空', 2, 1 ), //字段类型
		);

	/**
	 * 添加字段时检测字段是否存在
	 *
	 * @param $name
	 * @param $value
	 * @param $msg
	 * @param $arg
	 *
	 * @return mixed
	 */
	public function hasField( $name, $value, $msg, $arg ) {
		$table = $this->getTableName();
		if ( M()->fieldExists( $value, $table ) ) {
			return $msg;
		} else {
			return true;
		}
	}

	/**
	 * 自动完成
	 *
	 * @var array
	 */
	public $auto
		= array(
			array( "field_name", "strtolower", "function", 2, 1 ), //字段名
			array( "table_name", "getTableName", "method", 2, 1 ), //字段名
		);

	/**
	 * 添加字段时获取表名
	 *
	 * @param string $v
	 *
	 * @return string
	 */
	public function getTableName( $v = '' ) {
		/**
		 * 表类型
		 * 1 主表
		 * 2 副表
		 */
		$table_type = Q( 'table_type', null, 'intval' );
		/**
		 * 根据表类型获取
		 */
		switch ( $table_type ) {
			case 1: //主表
				$table
					= $this->model[ $this->mid ]['table_name'];
				break;
			case 2: //副表
				$table
					= $this->model[ $this->mid ]['table_name']
					  . '_data';
				break;
		}

		return $table;
	}

	/**
	 * 构造函数
	 */
	public function __init() {
		$this->mid = Q( 'mid', 0, 'intval' );
		//字段所在表模型信息
		$this->model = S( "model" );
		//字段缓存
		$this->field = S( 'field' . $this->mid );
	}

	/**
	 * 获得字段模型
	 */
	static public function getInstance() {
		$field_type = Q( 'field_type', null, 'trim' );
		$class      = ucfirst( $field_type ) . 'Model';
		$status     = import(
			CONTROLLER_VIEW_PATH . "Data/{$field_type}/{$class}"
		);
		if ( $status && class_exists( $class ) ) {
			return new $class;
		}
	}


	/**
	 * 删除字段
	 *
	 * @return mixed
	 */
	public function delField() {
		$fid = Q( 'fid' );
		//获得字段信息
		$field = M( 'field' )->find( $fid );
		if ( ! $field ) {
			$this->error = '字段不存在';

			return false;
		}
		//检测字段是否存在
		if ( $this->fieldExists( $field['field_name'], $field['table_name'] )
		) {
			//删除表字段
			$sql = "ALTER TABLE " . C( "DB_PREFIX" ) . $field['table_name']
			       . " DROP " . $field['field_name'];
			if ( $this->exe( $sql ) ) {
				/**
				 * 删除字段表记录
				 */
				if ( $this->del( $fid ) ) {
					//用于更新缓存使用
					$this->mid = $field['mid'];
					return $this->updateCache();
				} else {
					$this->error = '删除字段失败';
				}
			} else {
				$this->error = '更新表失败';
			}
		} else {
			$this->error = '字段不存在';
		}
	}

	/**
	 * 更新字段缓存
	 *
	 * @return bool
	 */
	public function updateCache() {
		$fieldData = M( "field" )->where( "mid={$this->mid}" )
		                         ->order( 'fieldsort ASC' )->all();
		$cacheData = array();
		foreach ( $fieldData as $field ) {
			$field['set']                      = unserialize( $field['set'] );
			$cacheData[ $field['field_name'] ] = $field;
		}
		if ( ! S( 'field' . $this->mid, $cacheData ) ) {
			$this->error = '更新字段缓存失败';

			return false;
		} else {
			$this->updateTableField();

			return true;
		}
	}

	/**
	 * 删除表字段结构缓存
	 *
	 * @return bool
	 */
	private function updateTableField() {
		$table = C( 'DB_DATABASE' ) . '.' . C( 'DB_PREFIX' )
		         . $this->model[ $this->mid ]['table_name'];
		$cache = array(
			$table,
			$table . '_data'
		);
		foreach ( $cache as $c ) {
			F( $c, null, APP_TABLE_PATH );
		}

		return true;
	}
}