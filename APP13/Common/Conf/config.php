<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'tpshop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀
    'DEFAULT_FILTER'        =>  'filterXSS',
    //邮箱发送配置
    'QQ_MAIL'=>array(
    'SMTP_HOST' => "smtp.qq.com",
    'SMTP_PORT' => 465,
    'MAIL_USER' => "1163551358@qq.com",
    'MAIL_PWD'  => "yaagbgmdximxbaee",
    'MAIL_FROM_ADDR' => "1163551358@qq.com",
    'MAIL_FROM_NAME' => "aa",
    'MAIL_SMTPSecure'=> "ssl", // 如果是25端口，则不需要加密，那么请留空！
    
),
    //短信发送配置
    'SMS_KEY'   =>'LTAIFOVUlQsouaEJ',//应用ID
    'SMS_Secret'=>'EfNfY5cZM8JT7zAo9GmgdWm9CcCy88',//应用密钥
);