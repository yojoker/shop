<?php
namespace Admin\Controller;
use Admin\Controller\CommonController as Controller;
class IndexController extends Controller {
    public function index(){
    	$this->display();
    }
    public function top(){
    	$this->display();
    }
    public function left(){
    	//获取当前登录管理员所拥有的角色信息
    	$where['role_id']=session('role_id');
    	$roleInfo=D('Role')->where($where)->find();

    	//获取当前管理员所拥有的权限信息
    	$top_where['auth_id']=array('IN',$roleInfo['auth_ids']);
    	$top_where['auth_pid']=0;
    	$top_where['is_menu']=1;
    	$this->topAuth=D('Auth')->where($top_where)->select();
         
    	//获取当前管理员拥有的子权限
    	$son_where['auth_id']=array('IN',$roleInfo['auth_ids']);
    	$son_where['auth_pid']=array('NEQ',0);
    	$son_where['is_menu']=1;
    	$this->sonAuth=D('Auth')->where($son_where)->select();

    	$this->display();
    }
    public function main(){
    	$this->display();
    }
    //管理员登录
    public function login(){
        if(IS_POST){
            $code=I('post.verify');
            $verify=new \Think\Verify();
            if(!$verify->check($code)){
                $this->error('验证码错误!');
            }
            //根据用户提交的帐号获取用户信息
            $where['username']=I('post.username');
            $adminInfo=D('Admin')->where($where)->find();
            if(!$adminInfo){
                $this->error('帐号或密码错误!');
            }
            //判断密码正确
            $password=I('post.password');
            $salt=$adminInfo['salt'];
            $pwd=$adminInfo['password'];
            if(password($password,$salt)==$pwd){
                //保存登录状态
                session('is_login',1);
                session('user_name',$adminInfo['username']);
                session('role_id',$adminInfo['role_id']);
                //更新当前管理员的登录状态
                D('Admin')->login_time=time();
                D('Admin')->login_ip=ip2long($_SESSION['REMOTE_ADDR']);//客户端的ip地址
                D('Admin')->save();
                $this->success('登录成功！',U('Index/index'));die;
            }else{
                 $this->error('帐号或密码错误!');
            }
        }
        $this->display();
    }
    //管理员退出
    public function logout(){
    	session('is_login',null);
    	session('user_name',null);
    	session('role_id',null);
    	$this->success('退出成功！',U('Index/login'));die;
        
    }
    public function code(){
      $config=array(
        'fontSize'=>24,
        'length'=>2,
        'imagew'=>220,

        );
      $verify=new \Think\Verify($config);
      $verify->entry();
    }
    //找回密码
    public function findpwd(){
        if(IS_POST){
            //根据邮箱地址和帐号查询对应的管理员信息
            $where['username']=I('post.username');
            $where['email']=I('post.email');
            $adminInfo=D('Admin')->where($where)->find();
            if(!$adminInfo){
                $this->error('帐号或者邮箱地址格式不正确！请重新确认！');
            }
            //生成随机串，保存到数据表
           $token=create_string(32);
           D('Admin')->token=$token;
           D('Admin')->save();
           //重置密码的链接地址
           $url=U('Index/resetpwd',array('token'=>$token),true,true);
           $content="尊敬的用户：<br>您正在通过邮件找回密码，请尽快点击<a href='$url'>当前链接</a>，进行密码重置操作。";
           $res=sendMail($adminInfo['mail'],$adminInfo['username'],'找回密码',$content);
           if($res){
            $this->success('邮件发送成功！请尽快重置密码！',U('Index/login'));die;
           }else{
            $this->error('邮件发送失败！请联系管理员！');die;
           }
        }
    	$this->display();
    }
    //重置密码
   public function resetpwd(){
    $admin=D('Admin');
    //判断是否有post数据提交
    if(IS_POST){
        $password=I('post.password');
        $password2=I('post.password2');
        if($password!=$password2){
            $this->error('重置密码失败！密码和确认密码必须一致！');
        }
        $data['salt']=create_string(6);
        $data['password']=password($password,$data['salt']);
        $token=I('post.token');
        $w['token']=$token;
        $res=$admin->where($w)->save($data);
        if($res){
            //重置密码成功以后
            $msg['token']=null;
            $admin->where($w)->save($msg);
            $this->success('重置密码成功！',U('Index/login'));die;
        }else{
            $this->error('重置密码失败！');
        }
}

        //接收找回密码的token值
        $token=I('get.token');
        $where['token']=$token;
        $this->adminInfo=$admin->where($where)->find();
        if(!$this->adminInfo){
          $this->error('非法访问！当前页面不存在！',U('Index/login'));die;  
        }
        $this->display();
    }
}