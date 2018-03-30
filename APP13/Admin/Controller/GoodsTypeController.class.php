<?php
namespace Admin\Controller;
use Admin\Controller\CommonController as Controller;
class GoodsTypeController extends Controller{

	public function _initialize(){

		$this->GoodsType=D('GoodsType');
	}
	//列表页
	public function index(){
		
		$this->total=$this->GoodsType->count();
		$page=new \Think\Page($this->total,4);
		$page->rollPage   = 3;// 分页栏每页显示的页数
		$page->lastSuffix = false; // 最后一页是否显示总页数
        $page->setConfig('prev','上页');  
        $page->setConfig('next','下页');  
        $page->setConfig('first','首页');  
        $page->setConfig('last','尾页');  
     	$this->pagehtml=$page->show();            
		$this->typeList=$this->GoodsType->limit($page->firstRow,$page->listRows)->select();
		
		$this->display();
	}
	//添加页
	public function add(){
		if(IS_POST){

			if(!$this->GoodsType->create() || !$this->GoodsType->add()){
				$this->error('添加类型失败！'.$this->GoodsType->getError());
			}
			$this->success('添加类型成功！',U('GoodsType/index'));die;
		}
		$this->display();
	}
	//编辑页
	public function edit(){
		if(IS_POST){
			if(!$this->GoodsType->create() || !$this->GoodsType->save()){
				$this->error('编辑类型失败！'.$this->GoodsType->getError());
			}
			$this->success('编辑类型成功！',U('GoodsType/index'));die;
		}
		$type_id=I('get.id',0,'intval');
	
		$this->goodsType=$this->GoodsType->find($type_id);
		if(!$this->goodsType){
			$this->error('非法参数,访问失败！');
		}
		//dump($this->goods);
		$this->display();
	}
	//删除
	public function del(){
		$type_id=I('get.id',0,'intval');
		$typeInfo=$this->GoodsType->find($type_id);
		if(!$typeInfo){
			$this->error('非法参数，访问失败！');
		}
		
		$res =$this->GoodsType->delete();
		if($res){
			$this->success('删除类型成功！',U('GoodsType/index'));die;
		}
		$this->error('删除类型失败！'.$this->GoodsType->getError());
	}
	public function delall(){
		$type_list=I('post.id');
		
		$where['type_id']=array('IN',$type_list);
		$res=$this->GoodsType->where($where)->delete();
		if($res){
			$data=array('status'=>true,'message'=>'删除成功!');
		}else{
			$data=array('status'=>false,'message'=>'删除失败!');
		}
		return $this->ajaxReturn($data);
	}


}