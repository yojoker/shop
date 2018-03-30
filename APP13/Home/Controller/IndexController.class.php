<?php
namespace Home\Controller;
use Home\Controller\CommonController as Controller;
class IndexController extends Controller {
    public function index(){
    	//获取所有的商品分类
    	$this->cateList=D('GoodsCategory')->where('is_show=1')->order('sort desc,cate_id asc')->select();
        $this->display();
    }
}