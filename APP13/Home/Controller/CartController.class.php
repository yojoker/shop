<?php
namespace Home\Controller;
use Home\Controller\CommonController as Controller;
class CartController extends Controller{
	//实例化购物类
	public function _initialize(){
		$this->cart=new \Commo\Library\Cart;
	}
	//购物车列表页
	public function index(){


	}
	//添加商品到购物车
	public function add(){

	}
	//更新购物车的商品信息
	public function edit(){
		
	}
	//从购物车移除 指定商品
	public function del(){

	}




}