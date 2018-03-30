<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".click").click(function() {
            $(".tip").fadeIn(200);
        });

        $(".tiptop a").click(function() {
            $(".tip").fadeOut(200);
        });

        $(".sure").click(function() {
            $(".tip").fadeOut(100);
        });

        $(".cancel").click(function() {
            $(".tip").fadeOut(100);
        });

    });
    </script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/index');?>" target="_top">首页</a></li>
            <li><a href="<?php echo U('Goods/index');?>">商品管理</a></li>
            <li>列表</li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><a href="<?php echo U('Goods/add');?>"><span><img src="/Public/Admin/images/t01.png" /></span>添加</a></li>
                <li><span><img src="/Public/Admin/images/t02.png" /></span>修改</li>
                <li><a href="<?php echo U('Goods/delall');?>" id="del_confirm"><span><img src="/Public/Admin/images/t03.png" /></span>删除</a></li>
                <li><span><img src="/Public/Admin/images/t04.png" /></span>统计</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="delall" type="checkbox" id="checkAll" />
                    </th>
                    <th>编号</th>
                    <th>标题</th>
                    <th>logo</th>
                    <th>分类</th>
                    <th>品牌</th>
                    <th>库存数量</th>
                    <th>销量</th>
                    <th>售价</th>
                    <th>市场价</th>
                    <th>上架时间</th>
                    <th>添加时间</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($goodsList)): foreach($goodsList as $key=>$goods): ?><tr>
                    <td>
                        <input name="del" value="<?php echo ($goods['goods_id']); ?>" type="checkbox" />
                    </td>
                     <td><?php echo ($goods['goods_id']); ?></td>
                    <td><?php echo (substr($goods['goods_name'],0,30)); ?></td>
                    <td>
                        <?php if($goods['goods_logo_thumb']!=''): ?><img style="max-height: 50px;max-width: 50px;" src="/Uploads/<?php echo ($goods['goods_logo_thumb']); ?>" /><?php endif; ?>
                    </td>
                    <td><?php echo ($goods['cate_id']); ?></td>
                    <td><?php echo ($goods['brand_id']); ?></td>
                    <td><?php echo ($goods['goods_number']); ?></td>
                    <td><?php echo ($goods['sale_number']); ?></td>
                    <td><?php echo ($goods['goods_price']); ?></td>
                    <td><?php echo ($goods['market_price']); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$goods['sale_time'])); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$goods['created_at'])); ?></td>
                    <td><?php echo ($goods['sort']); ?></td>
                    <td><a href="#" class="tablelink">查看</a>
                    <a href="<?php echo U('Goods/pics',array('id'=>$goods['goods_id']));?>" class="tablelink">相册</a>
                    <a href="<?php echo U('Goods/edit',array('id'=>$goods['goods_id']));?>" class="tablelink">编辑</a> <a href="<?php echo U('Goods/del',array('id'=>$goods['goods_id']));?>" class="tablelink"> 删除</a></td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
        <div class="pagin">
            <div class="message">共<i class="blue"><?php echo ($total); ?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo I('get.p',1,'intval');?>&nbsp;</i>页</div>
           <div  class="paginList"><?php echo ($pagehtml); ?></div>
        
        </div>
        <div class="tip">
            <div class="tiptop"><span>提示信息</span>
                <a></a>
            </div>
            <div class="tipinfo">
                <span><img src="/Public/Admin/images/ticon.png" /></span>
                <div class="tipright">
                    <p>是否确认对信息的修改 ？</p>
                    <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                </div>
            </div>
            <div class="tipbtn">
                <input name="" type="button" class="sure" value="确定" />&nbsp;
                <input name="" type="button" class="cancel" value="取消" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
        $('#checkAll').on('change',function(){
            $('input[name=del]').attr('checked',$(this).is(':checked'));
      
        });
        //批量删除的确认框
        $('#del_confirm').on('click',function(){
            var length=$('input[name=del]:checked').length;
            if(length<1){
                alert('您当前没有选择要删除的数据');
                return false;
            }
            if(!confirm('您确定要删除这些数据吗？')){
                return false;
            }
            var goods_list=[];
            $('input[name=del]:checked').each(function(key,item){
                goods_list.push(item.value);
            });
            goods_list=goods_list.join(',');
            data={
                'id':goods_list
            };
            $.post('<?php echo U("Goods/delall");?>',data,function(msg){
                //根据控制器返回结果，进行页面的操作
               if(msg.status){
                alert(msg.message);
                location.reload();//当前页面删除
               }
            },'json');
        });
    </script>
</body>

</html>