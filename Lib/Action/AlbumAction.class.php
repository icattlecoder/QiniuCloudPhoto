<?php
// 本类由系统自动生成，仅供测试用途
class AlbumAction extends Action {

    private $currentAlbum;
    private  $albums;

    public function _initialize() {
        $albumDB = M("album");
        $cond['uid'] = UID();
        $this->albums=$albumDB->where($cond)->select();
        $this->assign('albums',$this->albums);

    }

    public function index($id=1){
    	$photoDB = M("photo");
    	$cond['aid'] =  array('EQ', $id);
    	$photos = $photoDB->where($cond)->select();
        foreach ($this->albums as $key => $value) {
            if($value["id"] == $id){
                $this->currentAlbum = $this->albums[$key];
            }
        }
    	$this->assign('photos',$photos);
        $this->assign('currentAlbum',$this->currentAlbum);
    	$this->display();
    }

    public function photos($id=0){
    	$this->display();
    }

    /**
     * 设置相册 
    * @param string $photoname 照片
    * @param string $aid 相册
    */
    public function setCover($photoname,$aid){
        $albumDB = M("album");
        $data['uid'] = UID();
        $data['id'] = $aid;
        $data['cover'] = $photoname;
        $albumDB->save($data);
    }

    /**
     * 创建相册 
    * @param string $name 相册名称
    * @param string $description 相册描述
    */
    public function newAlbum($name,$description){
        $albumDB = M("album");
        $data['name'] = $name;
        $data['description'] = $description;
        $data['uid'] = UID();
        $aid = $albumDB->add($data);
        echo $aid;
    }
}