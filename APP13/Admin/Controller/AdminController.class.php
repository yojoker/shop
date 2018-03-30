<?php
namespace Admin\Controller;
use Admin\Controller\CommonController as Controller;
class AdminController extends Controller{

	public function _initialize(){

		$this->Admin=D('Admin');
	}
	//列表页
	public function index(){
		
		$this->total=$this->Admin->count();
		$page=new \Think\Page($this->total,4);
		$page->rollPage   = 3;// 分页栏每页显示的页数
		$page->lastSuffix = false; // 最后一页是否显示总页数
        $page->setConfig('prev','上页');  
        $page->setConfig('next','下页');  
        $page->setConfig('first','首页');  
        $page->setConfig('last','尾页');  
     	$this->pagehtml=$page->show();            
		$this->adminList=$this->Admin->alias('a')->join('__ROLE__ as r ON a.role_id=r.role_id')->limit($page->firstRow,$page->listRows)->select();
	
		$this->display();
	}
	//添加页
	public function add(){
		if(IS_POST){

			if(!$this->Admin->create() || !$this->Admin->add()){
				$this->error('添加管理员失败！'.$this->Admin->getError());
			}
			$this->success('添加管理员成功！',U('Admin/index'));die;
		}
		$this->roleList=D('Role')->select();
		$this->display();
	}
	//编辑页
	public function edit(){
		if(IS_POST){
			if(!$this->Admin->create() || !$this->Admin->save()){
				$this->error('编辑管理员失败！'.$this->Admin->getError());
			}
			$this->success('编辑管理员成功！',U('Admin/index'));die;
		}
		$admin_id=I('get.id',0,'intval');
	
		$this->Admin=$this->Admin->find($admin_id);
		if(!$this->Admin){
			$this->error('非法参数,访问失败！');
		}
		//dump($this->goods);
		$this->display();
	}
	//删除
	public function del(){
		$admin_id=I('get.id',0,'intval');
		$typeInfo=$this->Admin->find($admin_id);
		if(!$typeInfo){
			$this->error('非法参数，访问失败！');
		}
		
		$res =$this->Admin->delete();
		if($res){
			$this->success('删除管理员成功！',U('Admin/index'));die;
		}
		$this->error('删除管理员失败！'.$this->Admin->getError());
	}
	public function delall(){
		$admin_list=I('post.id');
		
		$where['admin_id']=array('IN',$admin_list);
		$res=$this->Admin->where($where)->delete();
		if($res){
			$data=array('status'=>true,'message'=>'删除成功!');
		}else{
			$data=array('status'=>false,'message'=>'删除失败!');
		}
		return $this->ajaxReturn($data);
	}


}