<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>欢迎登录京西商城后台管理系统</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
    <script src="/Public/Admin/js/cloud.js" type="text/javascript"></script>
    <script language="javascript">
    $(function() {
        $('.loginbox').css({
            'position': 'absolute',
            'left': ($(window).width() - 692) / 2
        });
        $(window).resize(function() {
            $('.loginbox').css({
                'position': 'absolute',
                'left': ($(window).width() - 692) / 2
            });
        });
    });
    </script>
    <style>
    .loginbox{ background-image: url('/Public/Admin/images/resetpwd.png'); }
    .loginbox ul li{ margin-bottom: 10px; }
    .logincode{ width: 100px;border-right: 1px solid #BAC7D2; border-radius: 0px 5px 5px 0px; }
    </style>
</head>

<body style="background-color:#1c77ac; background-image:url(/Public/Admin/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">
    <div id="mainBody">
        <div id="cloud1" class="cloud"></div>
        <div id="cloud2" class="cloud"></div>
    </div>
    <div class="logintop">
        <span>欢迎使用京西商城后台管理系统</span>
        <ul>
            <li><a href="/" target="_blank">商城首页</a></li>
        </ul>
    </div>
    <form action="<?php echo U('Index/resetpwd');?>" method="post">
        <div class="loginbody">
            <span class="systemlogo"></span>
            <div class="loginbox">
                <ul>
                    <li>
                    	<input type="hidden" name="token" value="<?php echo ($adminInfo['token']); ?>" />
                        <input readonly type="text" class="loginuser" placeholder="<?php echo ($adminInfo['username']); ?>" />
                    </li>
                    <li>
                        <input name="password" type="password" class="loginpwd" placeholder="密码" />
                    </li>
                    <li>
                        <input name="password2" type="password" class="loginpwd" placeholder="确认密码" />
                    </li>
                    <li>
                        <input name="" type="submit" class="loginbtn" value="确认修改" />
                    </li>
                </ul>
            </div>
        </div>
    </form>
    <div class="loginbm">版权所有 &copy;2016 <a href="http://www.itcast.cn/php">传智播客教育集团 PHP学院</a> </div>
</body>

</html>