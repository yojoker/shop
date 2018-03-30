<?php
  namespace Admin\Model;
  use Think\Model;
  // 商品信息模型
  class GoodsInfoModel extends Model{
    // 表名
    protected $tableName = "goods_info";
    // 字段定义
    protected $pk = 'goods_id';// 主键
    protected $fields = array('goods_id','type_id', 'goods_name', 'goods_price', 'goods_number', 'goods_weight', 'goods_desc', 'brand_id', 'cate_id', 'goods_logo_src', 'goods_logo_thumb', 'sale_time', 'created_at', 'updated_at', 'deleted_at','sort','sale_number','market_price');

    // 自动完成
    protected $_auto = array(
      // array('完成字段','完成规则','完成时间','附加规则');
      array('created_at','time', 1, 'function'),
      array('updated_at','time', 2, 'function'),
      array('sale_time', 'strtotime', 3, 'function'), // 上架时间
    );

    // 自动验证
    protected $_validate = array(
      // array('验证字段','验证规则','错误提示','验证条件','附加规则','验证时间'),
      // 验证字段  提交过来的表单name值
      // 验证规则  手册有常用的四个, url, require , email ,number,
      // 错误提示  验证失败以后返回的文本提示
      // 验证条件  0  如果有该字段提交上来则验证
      //           1  无论如何都要验证
      //           2  值不为空，则验证
      // 附件规则  对前面的验证规则进一步的补充和说明
      //           function   表示前面的规则写的是函数名
      //           callback   标签前面的规则写的是方法
      // 验证时间  1 添加时验证
      //           2 编辑时验证
      //           3 无论何时都要验证
      array('goods_name', 'require', '商品名称必须填写', 1, '', 3),
      array('goods_name', '', '商品名称已存在', 1, 'unique', 3),
      array('goods_price', 'currency', '价格格式不正确', 1, '', 3),
      array('goods_number', 'number', '数量必须是数值', 1, '', 3),

    );
  
    // 钩子方法
    // 预先在对应类中定义一些方法，然后在特定的时候自动执行，这种方法我们可以称之为钩子[hook]
    // _before_insert  自动在模型的添加方法add之前执行
    // _after_insert   自动在模型的添加方法add之后执行
    // 参数列表：
    // &$data    就是用户提交过来的数据[这里的数据已经执行了create方法]
    // $option   就是模型的名称和表名[如果时_before_update之类，还会把编辑、删除的条件保存到这里]
    public function _before_insert(&$data, $option){
      // 上传文件处理
      $res = $this->uploadfile($data,$options); 
      // 文件操作中，有可能会出现错误，那么如果出现错误，那么就应该停止执行操作
      if( $res === false ){
        return false;
      }

    }

    // 模型的编辑前置操作
    // $data     管理员提交过来的数据
    // $options  表名、模型名和编辑的条件
    public function _before_update(&$data,$options){
      // 上传文件处理
      $res = $this->uploadfile($data,$options);
      // 文件操作过程中有可能会出现错误，那么如果出现错误就应该停止执行当前函数的操作
      if( $res === false ){
        return false;
      }

      // 因为create方法中无法接受旧的图片地址，所以我们这里手动使用I函数来接受
      $old_logo_src   = I('post.old_logo_src');
      $old_logo_thumb = I('post.old_logo_thumb');
      // 判断新的$data数组图片地址是否和原来的图片地址一样，
      // 如果不一样，则证明本次编辑中，有图片上传。
      if( isset($data['goods_logo_src']) &&  ( $data['goods_logo_src'] != $old_logo_src ) ){
        $src   = './Uploads/' . $old_logo_src;  // 旧的原图
        $thumb = './Uploads/' . $old_logo_thumb;// 旧的缩略图
        if( is_file( $src ) ){
          unlink( $src );
          unlink( $thumb );
        }
      }

    }

    // 处理单个上传文件
    // 声明函数的时候，因为在当前方法内部有使用到$data，所以我们也需要把$data传入函数
    public function uploadfile(&$data,$options){
      if( isset( $_FILES['goods_logo_src'] ) && $_FILES['goods_logo_src']['name'] ){
        $config = array(
          'rootPath' => "./Uploads/",   // 这里的目录需要手动创建
          'savePath' => "Goods/",        // 这里的目录由ThinkPHP自动生成
          'maxSize'  => 8388608,  // 选中要运算的表达式，快捷键 Ctrl + Shift + Y ，进行数学运算
          'exts'     => array('png','jpeg','gif','jpg'),
        );

        $upload = new \Think\Upload($config);  // 实例化上传文件操作
        $info = $upload->uploadOne( $_FILES['goods_logo_src'] ); // 调用单个文件的上传功能
        if( !$info ){
          // 把上传文件的错误信息保存起来，在控制器中通过模型的getError方法显示出来
          $this->error = $upload->getError();
          return false; // 阻止当前函数的代码继续执行 
        }
        // 把上传图片的保存地址保存到 $data 中
        $data['goods_logo_src'] = $info['savepath'] . $info['savename'];
        // 给商品logo图片生成缩略图
        $image = new \Think\Image();    // 实例化图像处理类
        $image->open("./Uploads/" . $data['goods_logo_src']); // 打开要生成缩略图的图片
        // 生成缩略图并保存
        // thumb('宽度','高度','生成缩略图的类型'); // 生成缩略图的类型 常用的是2
        $data['goods_logo_thumb'] = $info['savepath'] .'thumb_'. $info['savename'];// 缩略图的地址
        $image->thumb(160,160,2)->save( './Uploads/' . $data['goods_logo_thumb'] );
      }
    }


    // 添加商品操作以后，添加商品属性
    // $data     就是添加操作时，保存到数据表中的数据[包括了商品id]
    // $option   就是模型的名称和表名
    public function _after_insert($data, $options ){
      $attr_id    = I('post.attr_id');   // 属性ID
      $attr_value = I('post.attr_value');     // 属性值
      $attr_price = I('post.attr_price');// 属性价格
      $goods_id   = $data['goods_id'];   // 商品ID

      $data = []; // 声明一个空数组，用于保存批量添加的属性数据
      // 因为三个子数组的成员数量都是一致，并且位置都是一一对应的，所以我们只需要循环其中一个即可。
      foreach( $attr_id as $key => $item ){
        $data[$key]['attr_id']    = $item;
        $data[$key]['attr_value'] = $attr_value[$key]; // 获取同样下标的属性值
        $data[$key]['attr_price'] = $attr_price[$key]; // 获取同样下标的属性价格
        $data[$key]['goods_id']   = $goods_id;
      }

      $res = D('GoodsAttributeValue')->addAll( $data );
      if( !$res ){
        $this->error =( "当前商品的属性值保存失败！请在编辑商品时进行属性的保存操作!");
        return false;
      }
    }
    //编辑商品成功以后的属性保存操作
     public function _after_update($data){
      $attr_id    = I('post.attr_id');   // 属性ID
      $attr_value = I('post.attr_value');     // 属性值
      $attr_price = I('post.attr_price');// 属性价格
      $goods_id   = $data['goods_id'];   // 商品ID
      //先把原来商品对应的属性信息删除
      $where['goods_id']=$goods_id;
      D('GoodsAttributeValue')->where($where)->delete();
      $data = []; // 声明一个空数组，用于保存批量添加的属性数据
      // 因为三个子数组的成员数量都是一致，并且位置都是一一对应的，所以我们只需要循环其中一个即可。
      foreach( $attr_id as $key => $item ){
        $data[$key]['attr_id']    = $item;
        $data[$key]['attr_value'] = $attr_value[$key]; // 获取同样下标的属性值
        $data[$key]['attr_price'] = $attr_price[$key]; // 获取同样下标的属性价格
        $data[$key]['goods_id']   = $goods_id;
      }

      $res = D('GoodsAttributeValue')->addAll( $data );
      if( !$res ){
        $this->error =( "当前商品的属性值保存失败！请在编辑商品时进行属性的保存操作!");
        return false;
      }
    }
  }