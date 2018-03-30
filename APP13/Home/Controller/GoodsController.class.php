<?php
namespace Home\Controller;
use Home\Controller\CommonController as Controller;
class GoodsController extends Controller{
	public function index(){
		//查询所有的商品信息
		$where['deleted_at']=0;
		$where['sale_time']=array('LT',time());
		$where['sale_time']=array('NEQ',0);
		//判断是否有分类参数
		if($cid=I("get.cid",0,'intval')){
			$where['cate_id']=$cid;
		}
		//判断是否有品牌参数
		if($bid=I('get.bid',0,'intval')){
			$where['brand_id']=$bid;
		}
		$this->goodsList= M('GoodsInfo')->where($where)->select();
		//dump($this->goodsList);
		$this->title='商品列表';

		$this->display();
	}
	public function detail(){
		//接受商品id
		$goods_id=I('get.id',0,'intval');
		$where['deleted_at']=0;
		$where['sale_time']=array('LT',time());
		$where['sale_time']=array('NEQ',0);
		//普通商品信息
		$this->goodsInfo= M('GoodsInfo')->where($where)->find($goods_id);
		if(!$this->goodsInfo){
			$this->error('页面不存在!');
		}
		//商品相册
		$w['goods_id']=$goods_id;
		$this->picsList=M('GoodsPics')->where($w)->select();
		//dump($this->picsList);die;
		//唯一属性
		$w['attr_sel']=0;
		$this->attrList=M('GoodsAttributeValue')->alias('gav')->join('__GOODS_ATTRIBUTE__ as ga ON ga.attr_id=gav.attr_id')->where($w)->select();
		//单选属性
		$w['attr_sel']=1;
		$radioAttrList=M('GoodsAttributeValue')->alias('gav')->join('__GOODS_ATTRIBUTE__ as ga ON ga.attr_id=gav.attr_id')->where($w)->select();
		//因为单选属性一个属性名称对应多个属性值的情况，所以我们要以属性ID进行分组
		$radio=[];
		foreach($radioAttrList as $item){
			$radio[$item['attr_name']][]=$item;
		}
		$this->radioAttrList=$radio;
		
		
		$this->display();
	}
}