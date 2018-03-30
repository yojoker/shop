<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{ //商品属性模型
	protected $tableName="user_info";
	protected $pk="user_id";
	protected $fields=array('user_id', 'username', 'password', 'salt', 'nickname', 'email', 'phone', 'openid', 'sex', 'check', 'check_code', 'login_time', 'login_ip', 'created_at', 'deleted_at');
	
	//验证
	protected $_validate=array(
		array('username','require','登陆账号必须填写！',1,'',3),
		array('username','','登陆账号已存在！',1,'unique',3),
		array('password','require','密码必须填写！',1,'',3),
		//验证用户密码和确认密码是否一致
		array('password','password2','两次密码必须一致！',2,'confirm',3),
		array('email','email','邮箱地址格式不正确！',1,'',3),
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