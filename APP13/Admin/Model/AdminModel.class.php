<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{ //商品属性模型
	protected $tableName="admin_info";
	protected $pk="admin_id";
	protected $fields=array('admin_id', 'username', 'password', 'salt', 'mail', 'phone', 'login_time', 'login_ip', 'deleted_at', 'created_at', 'disabled_at', 'token', 'role_id');
	
	//验证
	protected $_validate=array(
		array('username','require','用户名称必须填写！',1,'',3),
		array('username','','用户名称重复填写！',1,'unique',3),
		array('password','require','密码必须填写！',1,'',3),
		//验证用户密码和确认密码是否一致
		array('password','password2','两次密码必须一致！',2,'confirm',3),
		array('mail','email','邮箱地址格式不正确！',1,'',3),
		array('phone','/\d{11}/','手机好吗格式不正确',1,'regex',3)
		);
	//自动完成
	protected $_auto=array(
		array('created_at','time',1,'function')
		);
	//添加功能的前置钩子
	public function _before_insert(&$data,$options){
		$data['salt']=create_string(6);
		$data['password']=password($data['password'],$data['salt']);

	}
}