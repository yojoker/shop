<?php
namespace Admin\Model;
use Think\Model;
class GoodsAttributeModel extends Model{ //商品属性模型
	protected $tableName="goods_attribute";
	protected $pk="attr_id";
	protected $fields=array(
		'attr_id', 'attr_name', 'type_id', 'attr_sel', 'attr_write', 'attr_vals');
	
	//验证
	protected $_validate=array(
		array('attr_name','require','属性名称必须填写！',1,'',3),
		array('attr_name','','属性名称重复填写！',1,'unique',3),
		array('type_id','require','属性类型必须填写！',1,'',3)

		);
	//自动完成
	protected $_auto=array(
		array('attr_vals','transform',3,'callback')
		);
	//中文逗号转换
	public function transform($data){
		return str_replace('，', ',', $data);
	}
}