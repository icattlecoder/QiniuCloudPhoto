<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	 public function _initialize() {
	 	$albumDB = M("album");
        $cond['uid'] = UID();
        $albums=$albumDB->where($cond)->select();
        $this->assign('albums',$albums);
    }
    public function index(){
    	$this->show();
    }
}