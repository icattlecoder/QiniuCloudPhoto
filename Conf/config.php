<?php
return array(
	'db_type' => 'mysql',
	'db_host' => '127.0.0.1',
	'db_name' => 'webphotoDB',
	'db_user' => 'root',
	'db_pwd' => 'admin',
	'db_port' => 3306,
	'db_prefix' => 'qiniu_',
	'web_name' => 'Qiniu 云存储相册',
	'web_url' => 'http://localhost:8000/',
	'web_path' => '/',
	'web_icp' => '沪ICP备000000号',
	'CRON_MAX_TIME' => 60,
	'web_copyright' => '',
	'web_admin_pagenum' => 20,
	'web_home_pagenum' => 20,
	'accessKey' => 'iN7NgwM31j4-BZacMjPrOQBs34UG1maYCAQmhdCV',
	'secretKey' => '6QTOr2Jg1gcZEWDQXKOGZh5PziC2MCV5KsntT70j',
	'bucket' => 'qtestbucket',
	'qiniu_domain' => 'http://qtestbucket.qiniudn.com',
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则
		'album/:id\d'               => 'album/index'
		)
	);
?>