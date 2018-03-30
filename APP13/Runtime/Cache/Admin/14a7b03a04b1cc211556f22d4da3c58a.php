<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/index');?>" target="_top">首页</a></li>
            <li><a href="<?php echo U('Role/index');?>">角色管理</a></li>
            <li>列表</li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><span><a href="<?php echo U('Role/add');?>"><img src="/Public/Admin/images/t01.png" /></span>添加</a></li>
                <li id="del_confirm"><span><img src="/Public/Admin/images/t03.png" /></span>删除</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th width="3%"><input name="delall" type="checkbox" value="" id="checkAll" /></th>
                    <th width="5%">编号</th>
                    <th width="10%">角色</th>
                    <th width="18%">权限ids</th>
                    <th width="54%">权限ac</th>
                    <th width="10%">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($roleList)): foreach($roleList as $key=>$role): ?><tr>
                    <td><input name="del" type="checkbox" value="<?php echo ($role['role_id']); ?>" /></td>
                    <td><?php echo ($role['role_id']); ?></td>
                    <td><?php echo ($role['role_name']); ?></td>
                    <td><?php echo ($role['auth_ids']); ?></td>
                    <td><?php echo ($role['auth_vals']); ?></td>
                    <td><a href="<?php echo U('Role/auth',array('id'=>$role['role_id']));?>" class="tablelink">分配权限</a>
                    <a href="<?php echo U('Role/edit',array('id'=>$role['role_id']));?>" class="tablelink">编辑</a> <a href="<?php echo U('Role/del',array('id'=>$role['role_id']));?>" class="tablelink"> 删除</a></td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
                //批量删除的确认框
          $('#checkAll').on('change',function(){
        $('input[name=del]').attr('checked',$(this).is(':checked'));
      
        });
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
            $.post('<?php echo U("Role/delall");?>',data,function(msg){
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