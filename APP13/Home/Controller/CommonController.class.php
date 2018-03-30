<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->get_category();
	}
	public function get_category(){
		//获取全部商品分类
		$where['is_show']=1;
		$this->cateList=D('GoodsCategory')->where($where)->order('sort asc')->select();
	}
}