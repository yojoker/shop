<?php
namespace Admin\Controller;
use Admin\Controller\CommonController as Controller;
class GoodsAttributeController extends Controller{

	public function _initialize(){

		$this->GoodsAttribute=D('GoodsAttribute');
	}
	//列表页
	public function index(){
		
		$this->total=$this->GoodsAttribute->count();
		$page=new \Think\Page($this->total,4);
		$page->rollPage   = 3;// 分页栏每页显示的页数
		$page->lastSuffix = false; // 最后一页是否显示总页数
        $page->setConfig('prev','上页');  
        $page->setConfig('next','下页');  
        $page->setConfig('first','首页');  
        $page->setConfig('last','尾页');  
     	$this->pagehtml=$page->show();  
     	$type_id=I('get.id',0,'intval');
     	if($type_id>0){
     	$where['ga.type_id']=$type_id;	
     	}
     	         
		$this->attributeList=$this->GoodsAttribute->alias('ga')->join("__GOODS_TYPE__ as gt ON gt.`type_id`=ga.`type_id`")->limit($page->firstRow,$page->listRows)->where($where)->select();
		$this->typeList=D('GoodsType')->select();
		$this->display();
	}
	//添加页
	public function add(){
		if(IS_POST){

			if(!$this->GoodsAttribute->create() || !$this->GoodsAttribute->add()){
				$this->error('添加属性失败！'.$this->GoodsAttribute->getError());
			}
			$this->success('添加属性成功！',U('GoodsAttribute/index'));die;
		}
		$this->typeList=D('GoodsType')->select();

		$this->display();
	}
	//编辑页
	public function edit(){
		if(IS_POST){
			if(!$this->GoodsAttribute->create() || !$this->GoodsAttribute->save()){
				$this->error('编辑属性失败！'.$this->GoodsAttribute->getError());
			}
			$this->success('编辑属性成功！',U('GoodsAttribute/index'));die;
		}
		$attr_id=I('get.id',0,'intval');
	
		$this->goodsAttribute=$this->GoodsAttribute->find($attr_id);
		
		$this->typeList=D('GoodsType')->select();
		if(!$this->goodsAttribute){
			$this->error('非法参数,访问失败！');
		}
		//dump($this->goods);
		$this->display();
	}
	//删除
	public function del(){
		$attr_id=I('get.id',0,'intval');
		$attrInfo=$this->GoodsAttribute->find($attr_id);
		if(!$attrInfo){
			$this->error('非法参数，访问失败！');
		}
		
		$res =$this->GoodsAttribute->delete();
		if($res){
			$this->success('删除属性成功！',U('GoodsAttribute/index'));die;
		}
		$this->error('删除属性失败！'.$this->GoodsAttribute->getError());
	}
	//多选删除功能	
	public function delall(){
		$type_list=I('post.id');
		
		$where['attr_id']=array('IN',$type_list);
		$res=$this->GoodsAttribute->where($where)->delete();
		if($res){
			$data=array('status'=>true,'message'=>'删除成功!');
		}else{
			$data=array('status'=>false,'message'=>'删除失败!');
		}
		return $this->ajaxReturn($data);
	}
	//获取对应商品类型id的所有属性数据（ajax）
	public  function ajax_list(){
		if(!IS_AJAX){
			$this->error('非法访问！');
		}
		$type_id=I('post.id',0,'intval');
		$where['type_id']=$type_id;
		$data=$this->GoodsAttribute->where($where)->select();
		return $this->ajaxReturn($data);
	}

}