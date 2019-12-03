<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
 * 接口
 */
class Category extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['*'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['*'];
	
	
	
	public function getList(){
		if($this->request->isPost()){
			
			$category = db::name('category')->field('id, name, banner')->where(['type'=>'goods'])->order('id desc')->select();
			
			$goods = db::name('goods')->field('id, name, sales, images, price, category_id')->order('id desc')->select();
			
			foreach($category as $key => $val){
				$category[$key]['banner'] = FILE_PATH . $val['banner'];
				foreach($goods as $k => $v){
					if($val['id'] == $v['category_id']){
						$image = explode(',', $v['images']);
						$v['image'] = FILE_PATH . $image[0];
						$category[$key]['list'][] = $v;
						unset($goods[$k]);
					}
				}
			}
			$this->success('ok', $category);
			
		}
	}

    
	
	public function setImage($arr, $field = 'image'){
		foreach($arr as $key => $val){
			$arr[$key][$field] = FILE_PATH . $val[$field];
		}
		return $arr;
	}

}
