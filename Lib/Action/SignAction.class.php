<?php
require_once("php-sdk/qiniu/rs.php");

// 本类由系统自动生成，仅供测试用途
class SignAction extends Action {
	public function token($aid){
		$accessKey = C("accessKey");
		$secretKey = C("secretKey");
		$bucket = C("bucket");
		Qiniu_SetKeys($accessKey, $secretKey);
		$mac = new Qiniu_Mac($accessKey,$secretKey);
		$scope = $bucket;
		$policy = new Qiniu_RS_PutPolicy($scope);
		$policy->ReturnBody = '{"name":$(fname),"hash":$(etag),"x:aid":"'.$aid.'"}';
		$policy->Expires = 3600*24*30;
		echo $policy->token($mac);
	}
}