<?php 
function filterXSS($string){
    //相对index.php入口文件，引入HTMLPurifier.auto.php核心文件
    require_once './Public/Admin/htmlpurifier/HTMLPurifier.auto.php';
    // 生成配置对象
    $cfg = HTMLPurifier_Config::createDefault();
    // 以下就是配置：
    $cfg -> set('Core.Encoding', 'UTF-8');
    // 设置允许使用的HTML标签
    $cfg -> set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,br,p[style],span[style],img[width|height|alt|src]');
    // 设置允许出现的CSS样式属性
    $cfg -> set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
    // 设置a标签上是否允许使用target="_blank"
    $cfg -> set('HTML.TargetBlank', TRUE);
    // 使用配置生成过滤用的对象
    $obj = new HTMLPurifier($cfg);
    // 过滤字符串
    return $obj -> purify($string);
}

//随机数的生成
function create_string($len = 5){
  // 生成随机串的字典
  $dict = array_merge( range(0,9),range('a','z'),range('A','Z') );
  $str  = "";
  for($i = 0;$i<$len;$i++){
    shuffle($dict);
    $str .= $dict[0];
  }
  return $str;
}

//密码加密函数
function password($password,$salt){
	return sha1(md5($password).$salt);
}

/**
  * 递归方法实现无限极分类
  * @param array     $list                要生成树形列表的数组[该数组中必须要有主键id 和 父级pid]
  * @param int       $pid=0               父级id
  * @param int       $level=0             缩进次数[用于指定分类名称要缩进的数量]
  * @param string    $id_name='auth_id'   id的下标名称
  * @param string    $pid_name='auth_pid'  pid的下标名称
  */
function getTree($list,$pid=0,$level=0, $id_name='auth_id',$pid_name='auth_pid') {
	static $tree = array();      // static 表示声明一个静态变量, 静态变量在函数中会一直保存它的值
	foreach($list as $row) {
		if($row[$pid_name]==$pid) {
			$row['level'] = $level;  // 这个level是原来数组没有的，用于表示缩进的次数，
			$tree[] = $row;
			getTree($list, $row[$id_name], $level + 1); // 递归操作，重新把当前id传入函数中，获取当前id对应的子分类
		}
	}
	return $tree;
}
/**
 * [sendMail 邮件发送]
 * @param  [string] $address  [收件人的邮件地址]
 * @param  [string] $nickname [收件人的昵称]
 * @param  [string] $subject  [邮件的标题]
 * @param  [string] $content  [邮件的内容]
 * @return [boolean]          [返回结果，要么true,要么false]
 */
function sendMail($address, $nickname,$subject,$content ){

  //引入邮件发送的核心类，因为ThinkPHP是单入口，所以我们的路径都基于入口文件index.php来书写
  require "./plugin/mail/class.smtp.php";
  require "./plugin/mail/class.phpmailer.php";

  // 邮件发送的相关配置
  $config  = C('QQ_MAIL');

  // 实例化 PHPMailer类
  $mail = new PHPMailer;
  // 告诉 PHPMailer类 使用 SMTP 发送邮件
  $mail->isSMTP();

  // 设置邮件的编码格式
  $mail->CharSet = 'utf-8';

  // 邮箱的smtp服务器的地址[邮局的地址]
  $mail->Host = $config['SMTP_HOST'];

  // 设置SMTP端口号 - 例如 25, 465 or 587[ 网易使用的是25，而QQ使用的465，因为QQ的是加密的 ]
  $mail->Port = $config['SMTP_PORT'];

  $mail->SMTPSecure = $config['MAIL_SMTPSecure'];

  // 是否使用SMTP认证[帐号和授权码认证]
  $mail->SMTPAuth = true;
  
  // 帐号[ 邮箱帐号，登录邮箱的帐号，如果是QQ，则是QQ号码 ]
  $mail->Username = $config['MAIL_USER'];
  
  // 授权码[我们在第三方邮件发送平台开启smtp时设置的授权码，如果是QQ，则QQ邮箱会自动生成，而网易的是我们自定义]
  $mail->Password = $config['MAIL_PWD'];
  
  // 邮件发件人[完整的邮箱地址(不管是QQ还是网易)，发件人的昵称，例如京西商城]
  $mail->setFrom( $config['MAIL_FROM_ADDR'], $config['MAIL_FROM_NAME'] );
  
  // 邮件回复人[网站的邮箱地址和昵称，一般和上面的发件人是同一个]
  $mail->addReplyTo( $config['MAIL_FROM_ADDR'], $config['MAIL_FROM_NAME'] );
  
  // 邮件收件人[网站的邮箱地址和昵称]
  $mail->addAddress($address, $nickname );
  
  // 邮件的标题
  $mail->Subject = $subject;
  
  // 邮件的主体内容
  $mail->msgHTML($content);

  // 邮件的附件[不一定是图片，当然这个地址要根据自己当前页面来填写正确]
  // $mail->addAttachment('');

  //邮件发送，返回值是true/false
  return $mail->send();
}
