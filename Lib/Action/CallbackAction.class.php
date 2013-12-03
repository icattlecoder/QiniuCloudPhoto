<?php
require_once("php-sdk/qiniu/rs.php");

// 本类由系统自动生成，仅供测试用途
class CallbackAction extends Action {
	public function req(){

	}

	public function returnBody($name,$hash){
		if($_POST["x:aid"]){
			$photoDB = M("photo");
			$data['name'] = $name;
			$data['etag'] = $hash;
			$data['aid'] = $_POST['x:aid'];
			$data['uid'] = UID();
			$photoDB->add($data);

			$albumDB = M("album");
			$cond['id']=$_POST['x:aid'];
			$cond['uid']=UID();
			$album = $albumDB->where($cond)->find();
			if(!$album["cover"]){
				$album["cover"] = $hash;
				$albumDB->save($album);
			}	
		}
	}

	public function responseQiniu(){

	}
}