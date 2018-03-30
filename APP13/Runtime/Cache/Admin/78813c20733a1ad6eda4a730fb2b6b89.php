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
            <li><a href="<?php echo U('GoodsType/index');?>">商品类型管理</a></li>
            <li>列表</li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><a href="<?php echo U('GoodsType/add');?>"><span><img src="/Public/Admin/images/t01.png" /></span>添加</a></li>

                <li id="del_confirm"><span><img src="/Public/Admin/images/t03.png" /></span>删除</li>
  
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="delall" type="checkbox" value="" id="checkAll" />
                    </th>
                    <th>编号</th>
                    <th>类型名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($typeList)): foreach($typeList as $key=>$type): ?><tr>
                    <td>
                        <input name="del" type="checkbox" value="<?php echo ($type['type_id']); ?>" />
                    </td>
                    <td><?php echo ($type['type_id']); ?></td>
                    <td><?php echo ($type['type_name']); ?></td>
                    <td><a href="<?php echo U('GoodsAttribute/index',array('id'=>$type['type_id']));?>" class="tablelink">属性列表</a> 
                    <a href="<?php echo U('GoodsType/edit',array('id'=>$type['type_id']));?>" class="tablelink">编辑</a> <a href="<?php echo U('GoodsType/del',array('id'=>$type['type_id']));?>" class="tablelink"> 删除</a></td>
                </tr><?php endforeach; endif; ?> 
            </tbody>
        </table>
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
            $.post('<?php echo U("GoodsType/delall");?>',data,function(msg){
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