<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
 * 接口
 */
class Home extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['*'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['*'];
	
	public $pageSize = 10;
	
	public function goods(){
		if($this->request->isPost()){
			$post = $this->request->param();
			$page = $post['page'];
			$start = ($page - 1) * $this->pageSize;
			$goods = db::name('goods')->field('id, name, sales, images, price')->order('id desc')->limit($start, $this->pageSize)->select();
			foreach($goods as $key => $val){
				$image = explode(',', $val['images']);
				$goods[$key]['image'] = FILE_PATH . $image[0];
			}
			$data = [];
			$data['goods'] = $goods;
			$data['pageSize'] = $this->pageSize;
			
			$this->success('ok', $data);
		}
	}

    public function getData(){
		if($this->request->isPost()){
			$data = [];
			$banner = db::name('banner')->field('image, url')->select();
			$data['banner'] = $this->setImage($banner);
			$where = [
				'type' => 'goods',
				'pid' => 0,
				'flag' => 'index',
			];
			$field = 'id, name, image';
			$category = db::name('category')->where($where)->field($field)->select();
			$data['category'] = $this->setImage($category);
			$goods = db::name('goods')->field('id, name, sales, images, price')->order('id desc')->limit($this->pageSize)->select();
			foreach($goods as $key => $val){
				$image = explode(',', $val['images']);
				$goods[$key]['image'] = FILE_PATH . $image[0];
			}
			$data['goods'] = $goods;
			$data['pageSize'] = $this->pageSize;
			
			$this->success('ok', $data);
		}
	}
	
	public function setImage($arr, $field = 'image'){
		foreach($arr as $key => $val){
			$arr[$key][$field] = FILE_PATH . $val[$field];
		}
		return $arr;
	}

}
