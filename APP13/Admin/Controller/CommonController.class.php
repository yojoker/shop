<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
	//在构造函数里执行公共代码
	public function __construct(){
		parent::__construct();
		//登录防翻墙
		$this->check_login();
		$this->check_auth();
	}
	public function check_login(){
		$excep=array(
			'Index-login',
			'Index-code',
			'Index-findpwd',
			'Index-resetpwd'
			);
		//获取当前页面的控制器名和方法名
		$current=CONTROLLER_NAME.'-'.ACTION_NAME;
		//判断当前页面是否需要进行防翻墙功能
		if(in_array($current,$excep)){
			return ;
		}

		if(!session('?is_login')){
			$this->error('对不起！您尚未登录，请登录！',U('Index/login'));
		}
	}
	//权限防翻墙
	public function check_auth(){
			$excep=array(
			'Index-login',
			'Index-code',
			'Index-index',
			'Index-top',
			'Index-left',
			'Index-main',
			'Index-logout',
			'Index-findpwd',
			'Index-resetpwd'
			);
		//获取当前页面的控制器名和方法名
		$current=CONTROLLER_NAME.'-'.ACTION_NAME;
		//判断当前页面是否需要进行防翻墙功能
		if(in_array($current,$excep)){
			return ;
		}

		//权限防翻墙
		$where['role_id']=session('role_id');
		$roleInfo=D('Role')->where($where)->find();
		$auth=explode(',', $roleInfo['auth_vals']);
		if(!in_array($current,$auth)){
			$this->error('对不起！没有权限访问操作页面');
		}
	}
}