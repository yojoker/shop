<?php
namespace Admin\Model;
use Think\Model;
class GoodsTypeModel extends Model{
	protected $tableName="goods_type";
	protected $pk="type_id";
	protected $fields=array(
		'type_id', 'type_name');
	
	//验证
	protected $_validate=array(
		array('type_name','require','类型名称必须填写！',1,'',3),
		array('type_name','','类型名称重复填写！',1,'unique',3),

		);


}