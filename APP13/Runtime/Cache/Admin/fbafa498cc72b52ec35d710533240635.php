<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加管理员</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/index');?>" target="_top">首页</a></li>
            <li><a href="<?php echo U('Admin/index');?>">管理员管理</a></li>
            <li>添加</li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle"><span>基本信息</span></div>
        <form action="" method="post">
            <ul class="forminfo">
                <li>
                    <label>登录帐号</label>
                    <input name="username" type="text" class="dfinput" />
                </li>
                <li>
                    <label>登录密码</label>
                    <input name="password" type="password" class="dfinput" />
                    <i></i>
                </li>
                <li>
                    <label>确认密码</label>
                    <input name="password2" type="password" class="dfinput" />
                    <i></i>
                </li>
                <li>
                    <label>角色</label>
                    <select name="role_id" class="dfinput">
                    <?php if(is_array($roleList)): foreach($roleList as $key=>$role): ?><option value="<?php echo ($role['role_id']); ?>"><?php echo ($role['role_name']); ?></option><?php endforeach; endif; ?>
                    </select>
                    <i></i>
                </li>        
                <li>
                    <label>邮箱地址</label>
                    <input name="mail" type="email" class="dfinput" />
                </li>
                <li>
                    <label>手机号码</label>
                    <input name="phone" type="text" class="dfinput" />
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input id="btnSubmit" type="submit" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
</html>