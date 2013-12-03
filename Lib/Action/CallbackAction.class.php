<?php
require_once("../../php-sdk/qiniu/rs.php");

// 本类由系统自动生成，仅供测试用途
class CallbackAction extends Action {
	public function req(){

	}

	public function returnBody($name,$hash){
		$photoDB = M("photo");
		$data['name'] = $name;
		$data['etag'] = $hash;
		$data['aid'] = $_POST['x:aid'];
		$data['uid'] = 1;
		$photoDB->add($data);
	}

	public function responseQiniu(){

	}
}