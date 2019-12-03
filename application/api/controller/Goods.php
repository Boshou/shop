<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
 * 接口
 */
class Goods extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['*'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['*'];
	
	
	
	public function getInfo(){
		if($this->request->isPost()){
			
			$post = $this->request->param();
			$data = db::name('goods')->where(['id'=>$post['goods_id']])->find();
			$images = explode(',', $data['images']);
			foreach($images as $key => $val){
				$data['image'][$key]['id'] = $key;
				$data['image'][$key]['image'] = FILE_PATH . $val;
			}
			$collection = db::name('collection')->where($post)->find();
			$data['collection'] = $collection ? true : false;
			$this->success('ok', $data);
		}
	}

    
	
	public function setImage($arr, $field = 'image'){
		foreach($arr as $key => $val){
			$arr[$key][$field]['id'] = $key;
			$arr[$key][$field]['img'] = FILE_PATH . $val[$field];
		}
		return $arr;
	}

}
