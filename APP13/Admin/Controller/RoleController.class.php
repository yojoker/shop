<?php
namespace Admin\Controller;
use Admin\Controller\CommonController as Controller;
class RoleController extends Controller{

	public function _initialize(){

		$this->Role=D('Role');
	}
	//列表页
	public function index(){
		
		$this->total=$this->Role->count();
		$page=new \Think\Page($this->total,4);
		$page->rollPage   = 3;// 分页栏每页显示的页数
		$page->lastSuffix = false; // 最后一页是否显示总页数
        $page->setConfig('prev','上页');  
        $page->setConfig('next','下页');  
        $page->setConfig('first','首页');  
        $page->setConfig('last','尾页');  
     	$this->pagehtml=$page->show();            
		$this->roleList=$this->Role->limit($page->firstRow,$page->listRows)->select();
		
		$this->display();
	}
	//添加页
	public function add(){
		if(IS_POST){

			if(!$this->Role->create() || !$this->Role->add()){
				$this->error('添加角色失败！'.$this->Role->getError());
			}
			$this->success('添加角色成功！',U('Role/index'));die;
		}

		$this->display();
	}
	//编辑页
	public function edit(){
		if(IS_POST){
			if(!$this->Role->create() || !$this->Role->save()){
				$this->error('编辑角色失败！'.$this->Role->getError());
			}
			$this->success('编辑角色成功！',U('Role/index'));die;
		}
		$role_id=I('get.id',0,'intval');
	
		$this->Role=$this->Role->find($role_id);
		if(!$this->Role){
			$this->error('非法参数,访问失败！');
		}
		//dump($this->goods);
		$this->display();
	}
	//删除
	public function del(){
		$role_id=I('get.id',0,'intval');
		$roleInfo=$this->Role->find($role_id);
		if(!$roleInfo){
			$this->error('非法参数，访问失败！');
		}
		
		$res =$this->Role->delete();
		if($res){
			$this->success('删除角色成功！',U('Role/index'));die;
		}
		$this->error('删除角色失败！'.$this->Role->getError());
	}
	public function delall(){
		$role_list=I('post.id');
		
		$where['role_id']=array('IN',$role_list);
		$res=$this->Role->where($where)->delete();
		if($res){
			$data=array('status'=>true,'message'=>'删除成功!');
		}else{
			$data=array('status'=>false,'message'=>'删除失败!');
		}
		return $this->ajaxReturn($data);
	}

	//分配权限
	public function auth(){
		$auth=D('Auth');
		$role=D('Role');
		if(IS_POST){
			$data['role_id']=I('post.role_id');
			$data['auth_ids']=implode(',',I('post.auth_id'));
			$where['auth_pid']=array('NEQ',0);
			$where['auth_id']=array('IN',$data['auth_ids']);
			$auth_vals=$auth->where($where)->select();
			$vals=[];
			foreach($auth_vals as $item){
				$vals[]=$item['auth_controller'].'-'.$item['auth_action'];
			}
			$data['auth_vals']=implode(',',$vals);
			if($role->save($data)){
				$this->success('分配权限成功！',U('Role/index'));die;
			}else{
				$this->error('分配权限失败！');
			}
			
		}
		$where['auth_pid']=array('EQ',0);
		//查询所有顶级权限
		$this->topAuth=$auth->where($where)->select();
		//所有子权限
		$where['auth_pid']=array('NEQ',0);
		
		$this->sonAuth=$auth->where($where)->select();
		//获取role_id对应的角色信息
		$role_id=I('get.id');
		$this->roleInfo=$role->find($role_id);
		$this->roleAuth=explode(',', $this->roleInfo['auth_ids']);//当前角色所拥有的权限
		$this->display();
	}
}