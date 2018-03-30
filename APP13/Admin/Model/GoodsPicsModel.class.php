<?php
namespace Admin\Model;
use Think\Model;
class GoodsPicsModel extends Model{
	protected $tableName="goods_pics";
	protected $pk="pics_id";
	protected $fields=array(
		'pics_id', 'goods_id', 'pics_bg', 'pics_md', 'pics_sm' );
	
	//验证
	protected $_validate=array(
		array('goods_id','require','商品ID必须填写！',1,'',3)

		);
	public function mul_pics(){
		$config=array(
				'rootPath'=>"./Uploads/",
				'savePath'=>"Pics/",
				'maxSize'=>8388608,
				'exts'=>array('png','jpeg','jpg','gif')

				);
			$upload=new \Think\Upload($config);
			$info=$upload->upload();
			$image=new \Think\Image();
			$goods_id=I('post.goods_id');
			//把所有的大图循环，生成每一个大图对应的中图和小图
			$data=[];
			foreach ($info as $key => $item) {
				$pics_bg=$item['savepath'].$item['savename'];
				$data[$key]['pics_bg']=$pics_bg;
				$image->open("./Uploads/".$pics_bg);//打开大图

				$pics_md=$item['savepath'].'md_'.$item['savename'];
				$data[$key]['pics_md']=$pics_md;
				$image->thumb(350,350,2)->save("./Uploads/".$pics_md);
				$pics_sm=$item['savepath'].'sm_'.$item['savename'];
				$data[$key]['pics_sm']=$pics_sm;
				$image->thumb(50,50,2)->save("./Uploads/".$pics_sm);
				$data[$key]['goods_id']=$goods_id;
			}
			$res=$this->addAll($data);
			return $res;
	}


}