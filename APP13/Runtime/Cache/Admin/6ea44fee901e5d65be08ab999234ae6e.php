<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理员列表</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
</head>
<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/index');?>" target="_top">首页</a></li>
            <li><a href="<?php echo U('Admin/index');?>">管理员管理</a></li>
            <li>列表</li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><a href="<?php echo U('Admin/add');?>"><span><img src="/Public/Admin/images/t01.png" /></span>添加</a></li>
                <li><span><img src="/Public/Admin/images/t02.png" /></span>修改</li>
                <li><span><img src="/Public/Admin/images/t03.png" /></span>删除</li>
                <li><span><img src="/Public/Admin/images/t04.png" /></span>统计</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="" type="checkbox" value="" id="checkAll" />
                    </th>
                    <th>ID</th>
                    <th>登录帐号</th>
                    <th>角色名称</th>
                    <th>邮箱地址</th>
                    <th>手机号码</th>
                    <th>最后登录时间</th>
                    <th>最后登录IP地址</th>
                    <th>是否禁用</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($adminList)): foreach($adminList as $key=>$admin): ?><tr>
                <td><input name="del[]" type="checkbox" value="" /></td>
                <td><?php echo ($admin['admin_id']); ?></td>
                <td><?php echo ($admin['username']); ?></td>
                <td><?php echo ($admin['role_name']); ?></td>
                <td><?php echo ($admin['mail']); ?></td>
                <td><?php echo ($admin['phone']); ?></td>
                <td><?php echo (date('Y-m-d H:i:s',$admin['login_time'])); ?></td>
                <td><?php echo ($admin['login_ip']); ?></td>
                <td><?php echo ($admin['disabled_at']==0?'启用':'禁用'); ?></td>
                <td><?php echo (date('Y-m-d H:i:s',$admin['created_at'])); ?></td>
                <td>
                    <a href="<?php echo U('Admin/edit',array('id'=>$admin['admin_id']));?>" class="tablelink">编辑</a>
                    <a href="<?php echo U('Admin/del',array('id'=>$admin['admin_id']));?>" class="tablelink">删除</a>
                </td>
              </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
</body>

</html>