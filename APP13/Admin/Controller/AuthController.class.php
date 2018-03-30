<?php
namespace Admin\Controller;
use Admin\Controller\CommonController as Controller;
class AuthController extends Controller{

	public function _initialize(){

		$this->Auth=D('Auth');
	}
	//列表页
	public function index(){
		
		$this->total=$this->Auth->count();
		$page=new \Think\Page($this->total,100);
		$page->rollPage   = 3;// 分页栏每页显示的页数
		$page->lastSuffix = false; // 最后一页是否显示总页数
        $page->setConfig('prev','上页');  
        $page->setConfig('next','下页');  
        $page->setConfig('first','首页');  
        $page->setConfig('last','尾页');  
     	$this->pagehtml=$page->show();            
		$authList=$this->Auth->limit($page->firstRow,$page->listRows)->select();
		//生成具有层级效果的权限信息数组
		$this->authList=getTree($authList);
		$this->display();
	}
	//添加页
	public function add(){
		if(IS_POST){

			if(!$this->Auth->create() || !$this->Auth->add()){
				$this->error('添加权限失败！'.$this->Auth->getError());
			}
			$this->success('添加权限成功！',U('Auth/index'));die;
		}
		$where['auth_pid']=0;
		$this->topAuth=$this->Auth->where($where)->select();

		$this->display();
	}
	//编辑页
	public function edit(){
		if(IS_POST){
			if(!$this->Auth->create() || !$this->Auth->save()){
				$this->error('编辑权限失败！'.$this->Auth->getError());
			}
			$this->success('编辑权限成功！',U('Auth/index'));die;
		}
		$auth_id=I('get.id',0,'intval');
	
		$this->auth=$this->Auth->find($auth_id);
		if(!$this->auth){
			$this->error('非法参数,访问失败！');
		}
		//dump($this->goods);
		$this->display();
	}
	//删除
	public function del(){
		$auth_id=I('get.id',0,'intval');
		$authInfo=$this->Auth->find($auth_id);
		if(!$authInfo){
			$this->error('非法参数，访问失败！');
		}
		
		$res =$this->Auth->delete();
		if($res){
			$this->success('删除权限成功！',U('Auth/index'));die;
		}
		$this->error('删除权限失败！'.$this->Auth->getError());
	}
	public function delall(){
		$auth_list=I('post.id');
		
		$where['auth_id']=array('IN',$auth_list);
		$res=$this->Auth->where($where)->delete();
		if($res){
			$data=array('status'=>true,'message'=>'删除成功!');
		}else{
			$data=array('status'=>false,'message'=>'删除失败!');
		}
		return $this->ajaxReturn($data);
	}


}