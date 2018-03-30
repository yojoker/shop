<?php
namespace Admin\Model;
use Think\Model;
class GoodsAttributeValueModel extends Model{
	protected $tableName="goods_attribute_value";
	protected $pk="	value_id";
	protected $fields=array(
		'value_id', 'goods_id', 'attr_id', 'attr_value', 'attr_price');
	
	//验证
	protected $_validate=array(
		array('goods_id','require','商品ID必须填写！',1,'',3),
		array('attr_id','require','属性ID名称重复填写！',1,'',3),
		array('attr_value','require','属性值必须填写！',1,'',3),

		);


}