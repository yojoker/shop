<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>商品相册</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="/Public/Admin/js/lightbox/css/lightbox.css" />
    <script src="/Public/Admin/js/jquery.js"></script>
    <style>
    /* vertical-align 垂直对齐 */
    .add_btn,.sub_btn{cursor: pointer;font-size:16px;vertical-align: top;}
    .pics_list::after{ margin-bottom: 20px; content: ''; display: block; clear: both; }
    .pics_list li{ float: left; border:1px solid #ccc; margin: 4px 10px;position: relative; }
    .pics_list li .del_pics{ cursor: pointer; position: absolute; top: -12px; right: -12px; font-size: 12px; line-height: 150%; border-radius: 50%;padding: 0px 6px; background: #eee; }
    .pics_list li .del_pics:hover{ background: red; color: #fff; }
    </style>
</head>
<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/index');?>" target="_top">首页</a></li>
            <li><a href="<?php echo U('Goods/index');?>">商品管理</a></li>
            <li><strong><?php echo ($goodsInfo['goods_name']); ?></strong>的商品相册</li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
            <span class="current">相册列表</span>
        </div>
        
        <!-- 相册列表 -->
        <ul class="pics_list">
          <?php if(is_array($picsList)): foreach($picsList as $key=>$pics): ?><li>
            <span class="del_pics" data-id="<?php echo ($pics['pics_id']); ?>">x</span>
            <a href="/Uploads/<?php echo ($pics['pics_bg']); ?>" data-lightbox='my' data-title='my'>
            <img width="54" src="/Uploads/<?php echo ($pics['pics_sm']); ?>" alt="" />
            </a>
          </li><?php endforeach; endif; ?>
        </ul>
       
        <!-- 添加相册 -->
        <form action="<?php echo U('Goods/pics');?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="goods_id" value="<?php echo ($goods_id); ?>"></input>
            <ul class="forminfo current">
                <li>
                    <img src="/Public/Admin/images/t01.png" class="add_btn">
                    <input type="file" name="pics_bg[]" />
                </li>
                <li>
                    <img src="/Public/Admin/images/t03.png" class="sub_btn">
                    <input type="file" name="pics_bg[]" />
                </li>
            </ul>
            <ul>
                <li>
                    <label>&nbsp;</label>
                    <input id="btnSubmit" type="submit" class="btn" value="确认上传" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script>
    $(function(){
        $('.add_btn').on('click',function(){
            var _parent =$(this).parent();
            var li=_parent.clone();
            li.find('img').attr('src','/Public/Admin/images/t03.png').removeClass('add_btn').addClass('sub_btn');
            li.find('input').val("");
            _parent.after(li);
        });
        $(document).on('click','.sub_btn',function(){
            var _parent=$(this).parent();
            _parent.remove();
        });
        $('.del_pics').on('click',function(){
            var pics_id=$(this).data('id');
            var data={
                'pics_id':pics_id,
            };
            var _this=$(this);
        $.get('<?php echo U("Goods/delpics");?>',data,function(msg){
                if(msg.status){
                    alert(msg.message);
                    _this.parent().remove();
                }
            },'json');
        })
    });
</script>
<script type="text/javascript" src="/Public/Admin/js/lightbox/js/lightbox-plus-jquery.js"></script>

</html>