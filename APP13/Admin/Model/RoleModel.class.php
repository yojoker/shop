<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model{ //商品属性模型
	protected $tableName="role";
	protected $pk="role_id";
	protected $fields=array(
		 'role_id', 'role_name', 'auth_ids', 'auth_vals');
	
	//验证
	protected $_validate=array(
		array('role_name','require','角色名称必须填写！',1,'',3),
		array('role_name','','角色名称重复填写！',1,'unique',3)
		);
}