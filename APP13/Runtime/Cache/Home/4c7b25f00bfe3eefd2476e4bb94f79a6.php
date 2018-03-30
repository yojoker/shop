<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>用户中心</title>
	<link rel="stylesheet" href="/tpshop/Public/Home/style/base.css" type="text/css">
	<link rel="stylesheet" href="/tpshop/Public/Home/style/global.css" type="text/css">
	<link rel="stylesheet" href="/tpshop/Public/Home/style/header.css" type="text/css">
	<link rel="stylesheet" href="/tpshop/Public/Home/style/home.css" type="text/css">
	<link rel="stylesheet" href="/tpshop/Public/Home/style/user.css" type="text/css">
	<link rel="stylesheet" href="/tpshop/Public/Home/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/tpshop/Public/Home/style/footer.css" type="text/css">

	<script type="text/javascript" src="/tpshop/Public/Home/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/tpshop/Public/Home/js/header.js"></script>
	<script type="text/javascript" src="/tpshop/Public/Home/js/home.js"></script>
</head>
<body>
		<!-- 顶部导航 start -->
	<div class="topnav">
		<div class="topnav_bd w1210 bc">
			<div class="topnav_left">
				
			</div>
			<div class="topnav_right fr">
				<ul>
					<li>您好，欢迎来到京西！[<a href="<?php echo U('User/login');?>">登录</a>] [<a href="<?php echo U('User/register');?>">免费注册</a>] </li>
					<li class="line">|</li>
					<li>我的订单</li>
					<li class="line">|</li>
					<li>客户服务</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>

	<!-- 头部 start -->
	<div class="header w1210 bc mt15">
		<!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
		<div class="logo w1210">
			<h1 class="fl"><a href="<?php echo U('Index/index');?>"><img src="/tpshop/Public/Home/images/logo.png" alt="京西商城"></a></h1>
			<!-- 头部搜索 start -->
			<div class="search fl">
				<div class="search_form">
					<div class="form_left fl"></div>
					<form action="" name="serarch" method="get" class="fl">
						<input type="text" class="txt" value="请输入商品关键字" /><input type="submit" class="btn" value="搜索" />
					</form>
					<div class="form_right fl"></div>
				</div>
				
				<div style="clear:both;"></div>

				<div class="hot_search">
					<strong>热门搜索:</strong>
					<a href="">D-Link无线路由</a>
					<a href="">休闲男鞋</a>
					<a href="">TCL空调</a>
					<a href="">耐克篮球鞋</a>
				</div>
			</div>
			<!-- 头部搜索 end -->

			<!-- 用户中心 start-->
			<div class="user fl">
				<dl>
					<dt>
						<em></em>
						<a href="">用户中心</a>
						<b></b>
					</dt>
					<dd>
						<div class="prompt">
							您好，请<a href="">登录</a>
						</div>
						<div class="uclist mt10">
							<ul class="list1 fl">
								<li><a href="">用户信息></a></li>
								<li><a href="">我的订单></a></li>
								<li><a href="">收货地址></a></li>
								<li><a href="">我的收藏></a></li>
							</ul>

							<ul class="fl">
								<li><a href="">我的留言></a></li>
								<li><a href="">我的红包></a></li>
								<li><a href="">我的评论></a></li>
								<li><a href="">资金管理></a></li>
							</ul>

						</div>
						<div style="clear:both;"></div>
						<div class="viewlist mt10">
							<h3>最近浏览的商品：</h3>
							<ul>
								<li><a href=""><img src="/tpshop/Public/Home/images/view_list1.jpg" alt="" /></a></li>
								<li><a href=""><img src="/tpshop/Public/Home/images/view_list2.jpg" alt="" /></a></li>
								<li><a href=""><img src="/tpshop/Public/Home/images/view_list3.jpg" alt="" /></a></li>
							</ul>
						</div>
					</dd>
				</dl>
			</div>
			<!-- 用户中心 end-->

			<!-- 购物车 start -->
			<div class="cart fl">
				<dl>
					<dt>
						<a href="">去购物车结算</a>
						<b></b>
					</dt>
					<dd>
						<div class="prompt">
							购物车中还没有商品，赶紧选购吧！
						</div>
					</dd>
				</dl>
			</div>
			<!-- 购物车 end -->
		</div>
		<!-- 头部上半部分 end -->
		
		<div style="clear:both;"></div>
	


  <link rel="stylesheet" href=" /tpshop/Public/Home/style/login.css" type="text/css">
  <style>
    /* 原来的输入太长了，我们的短信验证码的框不需要那么长 */
    .login_form .txt2{
      width: 150px;
    }
    .sms_btn{
      color: #fff;
      background-color: #ff4444;
      display: inline-block;
      cursor: pointer;
      height: 32px;
      line-height: 32px;
      font-size: 14px;
      width: 140px;
      text-align: center;
    }
    .disabled{
      cursor: no-drop;
      background-color: #ffaaaa;
    }
  </style>

	<!-- 登录主体部分start -->
	<div class="login w990 bc mt10 regist">
		<div class="login_hd">
			<h2>用户注册</h2>
			<b></b>
		</div>
		<div class="login_bd">
			<div class="login_form fl">
				<form action="<?php echo U('User/register');?>" method="post">
					<ul>
						<li>
              <label for="">用户名：</label>
              <input type="text" class="txt" name="username" />
              <p>3-20位字符，可由中文、字母、数字和下划线组成</p>
            </li>
            <li>
							<label for="">昵称：</label>
							<input type="text" class="txt" name="nickname" />
							<p>可由中文、字母、数字和下划线组成</p>
						</li>
						<li>
							<label for="">手机号：</label>
							<input type="text" class="txt" name="phone" />
							<p>请填写正确的手机号码</p>
						</li>
						<li>
							<label for="">邮箱地址：</label>
							<input type="text" class="txt" name="email" />
							<p>请填写正确的邮箱地址，用于找回密码！</p>
						</li>						
						<li>
							<label for="">密码：</label>
							<input type="password" class="txt" name="password" />
							<p>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
						</li>
						<li>
							<label for="">确认密码：</label>
							<input type="password" class="txt" name="password2" />
							<p> <span>请再次输入密码</p>
						</li>
						<li>
							<label for="">验证码：</label>
							<input type="text" class="txt txt2" name="sms_code" />
							<span class="sms_btn">点击发送短信验证码</span>
							<p> <span>发送短信验证码</p>
						</li>						
						<li>
							<label for="">&nbsp;</label>
							<input type="checkbox" name="is_read" value="1" class="chb" checked="checked" /> 我已阅读并同意《用户注册协议》
						</li>
						<li>
							<label for="">&nbsp;</label>
							<input type="submit" value="" class="login_btn" />
						</li>
					</ul>
				</form>

				
			</div>
			
			<div class="mobile fl">
				<h3>手机快速注册</h3>			
				<p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
				<p><strong>1069099988</strong></p>
			</div>

		</div>
	</div>
	<!-- 登录主体部分end -->
	<div style="clear:both;"></div>
  
	<script>
		var t;          // 定时器的返回值
		var timer = false; // 表示是否进入计时状态，true表示正在倒计时， false表示没进入倒计时了。		
	  // 发送短信验证码
		$('.sms_btn').click(function(){
			 if( timer == true ){
         return false;
       }

			 // 接收手机号码
			 var mb = $('input[name=phone]').val();
       if( mb.length < 11 ){
          $('input[name=phone]').focus();
          return false;
       }

       timer = true;  // 进入倒计时了
       var _this = $(this); // 把当前被点击的按钮对象保存在变量中
			 var time = 60;
			 $('.sms_btn').addClass('disabled');   // 给按钮移除添加样式
       $('.sms_btn').html(time+'秒');  // 倒计时的读秒
			 clearInterval( t );
			 t = setInterval(function(){
			 	 if( time <= 1 ){
			 	 	 $('.sms_btn').removeClass('disabled'); // 给按钮 .sms_btn 移除禁用样式
			 	 	 _this.html( '点击发送短信验证码' );    // 把内容重新调整回来
			 	 	 timer = false;  //倒计时结束了，退出计时状态
			 	 	 clearInterval( t ); // 清除定时器
			 	 }else{
			 	 	 _this.html( --time + '秒' );   // 倒计时的读秒
			 	 }
			 },1000);

			 //使用ajax发送手机号到后台
       data={
        'phone':mb,
       };
       $.post('<?php echo U("User/sms");?>',data,function(msg){
        //提示用户发送短信是否成功
        alert(msg.message);
       },'json');
		});
	</script>

		

	<!-- 底部导航 start -->
	<div class="bottomnav w1210 bc mt10">
		<div class="bnav1">
			<h3><b></b> <em>购物指南</em></h3>
			<ul>
				<li><a href="">购物流程</a></li>
				<li><a href="">会员介绍</a></li>
				<li><a href="">团购/机票/充值/点卡</a></li>
				<li><a href="">常见问题</a></li>
				<li><a href="">大家电</a></li>
				<li><a href="">联系客服</a></li>
			</ul>
		</div>
		
		<div class="bnav2">
			<h3><b></b> <em>配送方式</em></h3>
			<ul>
				<li><a href="">上门自提</a></li>
				<li><a href="">快速运输</a></li>
				<li><a href="">特快专递（EMS）</a></li>
				<li><a href="">如何送礼</a></li>
				<li><a href="">海外购物</a></li>
			</ul>
		</div>

		
		<div class="bnav3">
			<h3><b></b> <em>支付方式</em></h3>
			<ul>
				<li><a href="">货到付款</a></li>
				<li><a href="">在线支付</a></li>
				<li><a href="">分期付款</a></li>
				<li><a href="">邮局汇款</a></li>
				<li><a href="">公司转账</a></li>
			</ul>
		</div>

		<div class="bnav4">
			<h3><b></b> <em>售后服务</em></h3>
			<ul>
				<li><a href="">退换货政策</a></li>
				<li><a href="">退换货流程</a></li>
				<li><a href="">价格保护</a></li>
				<li><a href="">退款说明</a></li>
				<li><a href="">返修/退换货</a></li>
				<li><a href="">退款申请</a></li>
			</ul>
		</div>

		<div class="bnav5">
			<h3><b></b> <em>特色服务</em></h3>
			<ul>
				<li><a href="">夺宝岛</a></li>
				<li><a href="">DIY装机</a></li>
				<li><a href="">延保服务</a></li>
				<li><a href="">家电下乡</a></li>
				<li><a href="">京东礼品卡</a></li>
				<li><a href="">能效补贴</a></li>
			</ul>
		</div>
	</div>
	<!-- 底部导航 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
	<div class="footer w1210 bc mt10">
		<p class="links">
			<a href="">关于我们</a> |
			<a href="">联系我们</a> |
			<a href="">人才招聘</a> |
			<a href="">商家入驻</a> |
			<a href="">千寻网</a> |
			<a href="">奢侈品网</a> |
			<a href="">广告服务</a> |
			<a href="">移动终端</a> |
			<a href="">友情链接</a> |
			<a href="">销售联盟</a> |
			<a href="">京西论坛</a>
		</p>
		<p class="copyright">
			 © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号 
		</p>
		<p class="auth">
			<a href=""><img src="/tpshop/Public/Home/images/xin.png" alt="" /></a>
			<a href=""><img src="/tpshop/Public/Home/images/kexin.jpg" alt="" /></a>
			<a href=""><img src="/tpshop/Public/Home/images/police.jpg" alt="" /></a>
			<a href=""><img src="/tpshop/Public/Home/images/beian.gif" alt="" /></a>
		</p>
	</div>
	<!-- 底部版权 end -->
</body>
</html>