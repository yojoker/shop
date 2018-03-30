<?php
namespace Home\Model;
use Think\Model;
class GoodsCategoryModel extends Model{
	protected $tableName='goods_category';
	protected $pk='cate_id';
	protected $fields=array(
		'cate_id', 'cate_pid', 'cate_name', 'description', 'keywords', 'is_show', 'show_nav', 'sort' 
		);
}