<?php
namespace Home\Controller;
use Home\Controller\CommonController as Controller;
class UserController extends Controller{
	
	//会员中心
	public function index(){
		$this->display();
	}
	//会员注册
	public function register(){
		$this->User=D('User');
		if(IS_POST){
			//验证短信验证码是否正确
			$code=I('post.sms_code');
			if($code!=session('sms_code')){
				$this->error('验证码有误！');
			}
			//判断是否在有效时间内
			if(time()-600 >session('sms_time')){
				$this->error('验证码超时，已失效！');
			}

			if(!$this->User->create() || !$user_id=$this->User->add()){
				$this->error('注册失败！'.$this->User->getError());
			}
			//保存登录状态
			session('user_login',1);
			session('nickname',I('post.nickname'));
			session('user_id',$user_id);
			//更新登录时间
			$data['user_id']=$user_id;
			$data['login_time']=time();
			$data['login_ip']=$_SERVER['REMOTE_ADDR'];
			$this->User->save($data);
			$this->success('注册成功！',U('User/index'));die;
		}
		$this->display();
	}
	//会员登录
	public function login(){
		if(IS_POST){
			//根据用户提交的帐号获取用户信息
		$where['username'] = I('post.username');
		$userInfo=D('User')->where($where)->find();
		if(!$userInfo){
			$this->error('帐号或密码错误！');
		}	
		//判断密码是否正确
		$password=I('post.password');
		$salt=$userInfo['salt'];
		$pwd=$userInfo('password');
		//使用自定义的辅助函数password对用户密码及盐值进行比对
		if(password($password,$salt)==$pwd){
			//保存登录状态
			session('user_login',1);
			session('user_id',$userInfo['user_id']);
			session('nickname',$userInfo['nickname']);
			//更新当前管理员的登录状态
			D('User')->login_time=time();
			D('User')->login_ip=$_SERVER['REMOTE_ADDR'];
			D('User')->save();
			$this->success('登录成功！',U('Index/index'));die;
		}else{
			$this->error('登录失败！帐号或密码错误！');
		}

		}
		$this->display();
	}

	//退出登录
	public function logout(){
   		session('user_login',null);
    	session('user_id',null);
    	$this->success('退出成功！',U('Index/index'));die;
	}
	//短信验证码功能
	public function sms(){
		// $phone="18225831885";
		// $data=array(
		// 	'number'=>'666666',
		// 	);
		// $res=\Common\Library\SmsDemo::sendSms($phone,$data);
		// dump($res);die;

		if(!IS_AJAX){
			$this->error('当前页面不存在！');
		}
		$phone=I("post.phone");
		$number=mt_rand(100000,999999);//生成随机6位验证码
		session('sms_code',$number);
		session('sms_time',time());
		$data=array(
			'number'=>$number,
			);
		//调用上面内置进来的短信发送功能
		$res= \Common\Library\Sms::sendSms($phone,$data);
		if($res->Code=='OK'){
			$data=array(
				'status'=>1,
				'message'=>'短信发送成功！',
				);
		}else{
			$data=array(
				'status'=>0,
				'message'=>'短信发送失败！请重新尝试或联系管理员！',
				);
		}
		return $this->ajaxReturn($data);
	}
}