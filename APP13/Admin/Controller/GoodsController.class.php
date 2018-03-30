<?php
namespace Admin\Controller;
use Admin\Controller\CommonController as Controller;
class GoodsController extends Controller{

	public function _initialize(){

		$this->GoodsInfo=D('GoodsInfo');
	}
	//列表页
	public function index(){
		$where['deleted_at']=0;
		$this->total=$this->GoodsInfo->count();
		$page=new \Think\Page($this->total,4);
		$page->rollPage   = 3;// 分页栏每页显示的页数
		$page->lastSuffix = false; // 最后一页是否显示总页数
        $page->setConfig('prev','上页');  
        $page->setConfig('next','下页');  
        $page->setConfig('first','首页');  
        $page->setConfig('last','尾页');  
     	$this->pagehtml=$page->show();            
		$this->goodsList=$this->GoodsInfo->field(
			'goods_id, goods_name, goods_price, goods_number, goods_weight, goods_desc, brand_id, cate_id, goods_logo_src, goods_logo_thumb, sale_time, created_at, updated_at,sort,sale_number,market_price')->order('sort asc,goods_id desc')->limit($page->firstRow,$page->listRows)->where($where)->select();
		//dump($this->goodsList[0]['goods_id']);die;
		
		$this->display();
	}
	//添加页
	public function add(){
		if(IS_POST){

			if(!$this->GoodsInfo->create() || !$this->GoodsInfo->add()){
				$this->error('添加商品失败！'.$this->GoodsInfo->getError());
			}
			$this->success('添加商品成功！',U('Goods/index'));die;
		}
		$this->typeList=D('GoodsType')->select();
		$this->display();
	}
	//编辑页
	public function edit(){
		if(IS_POST){
			if(!$this->GoodsInfo->create() || !$this->GoodsInfo->save()){
				$this->error('编辑商品失败！'.$this->GoodsInfo->getError());
			}
			$this->success('编辑商品成功！',U('Goods/index'));die;
		}
		$goods_id=I('get.id',0,'intval');
		$where['goods_id']=$goods_id;
		$this->goodsInfo=$this->GoodsInfo->where($where)->find();
		if(!$this->goodsInfo){
			$this->error('非法参数,访问失败！');
		}
		//查询当前商品的类型
		$this->typeList=D('GoodsType')->select();
		//查询当前商品的属性信息
		$GAV=D('GoodsAttributeValue');
		$this->goodsAttr=$GAV->alias('gav')->where($where)->join('__GOODS_ATTRIBUTE__ as ga ON ga.attr_id=gav.attr_id')->select();
		$this->display();
	}
	//删除
	public function del(){
		$goods_id=I('get.id',0,'intval');
		$goodsInfo=$this->GoodsInfo->find($goods_id);
		if(!$goodsInfo){
			$this->error('非法参数，访问失败！');
		}
		$where['goods_id']=$goods_id;
		$data['deleted_at']=time();
		$res =$this->GoodsInfo->where($where)->save($data);
		if($res){
			$this->success('删除商品成功！',U('Goods/index'));die;
		}
		$this->error('删除商品失败！'.$this->GoodsInfo->getError());
	}
	public function delall(){
		$goods_list=I('post.id');
		$data['deleted_at']=time();
		$where['goods_id']=array('IN',$goods_list);
		$res=$this->GoodsInfo->where($where)->save($data);
		if($res){
			$data=array('status'=>true,'message'=>'删除成功!');
		}else{
			$data=array('status'=>false,'message'=>'删除失败!');
		}
		return $this->ajaxReturn($data);
	}
	//相册
	public function pics(){
		$this->GoodsPics=D('GoodsPics');
		if(IS_POST){
			//$goods_id=I('post.goods_id');
			
			if(!$this->GoodsPics->mul_pics()){
				$this->error('上传相册图片处理失败！'.$this->getError());die;
			}
			$this->success('上传相册图片处理成功！',U('Goods/pics',array('id'=>I('post.goods_id'))));die;
		}
		$this->goods_id=I('get.id',0,'intval');
		//根据商品ID查询对应的相册图片
		$this->goodsInfo=$this->GoodsInfo->find($this->goods_id);
		$where['goods_id']=$this->goods_id;
		$this->picsList=$this->GoodsPics->where($where)->select();
		$this->display();
	}

	public function delpics(){
		if(!IS_AJAX){
			$this->error('非法请求！');die;
		}
		$this->GoodsPics=D('GoodsPics');
		$pics_id=I('get.pics_id');
		$picsInfo=$this->GoodsPics->find($pics_id);
		$pics_bg='./Uploads/'.$picsInfo['pics_bg'];
		$pics_md='./Uploads/'.$picsInfo['pics_md'];
		$pics_sm='./Uploads/'.$picsInfo['pics_sm'];
		if($this->GoodsPics->delete()){
			if(is_file($pics_bg)){
				unlink($pics_bg);
			}
			if(is_file($pics_md)){
				unlink($pics_md);
			}
			if(is_file($pics_sm)){
				unlink($pics_sm);
			}
			$data=array('status'=>true,'message'=>'删除图片成功!');
		}else{
			$data=array('status'=>false,'message'=>'删除图片失败!'.$this->GoodsPics->getError());
		}
		return $this->ajaxReturn($data);
	}

}