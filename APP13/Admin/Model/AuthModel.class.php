<?php
namespace Admin\Model;
use Think\Model;
class AuthModel extends Model{ //商品属性模型
	protected $tableName="auth";
	protected $pk="auth_id";
	protected $fields=array(
	 'auth_id', 'auth_name', 'auth_pid', 'auth_controller', 'auth_action', 'is_menu' );
	
	//验证
	protected $_validate=array(
		array('auth_name','require','权限名称必须填写！',1,'',3),

		//array('auth_pid','require','父级权限必须填写！',1,'',3),这里不需要验证，管理员如果没有对应的权限则默认是0

		);

}