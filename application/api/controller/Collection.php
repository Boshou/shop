<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
 * 接口
 */
class Collection extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['*'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['*'];
	
	
	
	public function add(){
		if($this->request->isPost()){
			
			$post = $this->request->param();
			
			$res = db::name('collection')->where($post)->find();
			if($res){
				db::name('collection')->where(['id'=>$res['id']])->delete();
				$this->success('取消收藏');
			}else{
				$post['createtime'] = time();
				$post['updatetime'] = time();
				db::name('collection')->insert($post);
				$this->success('已加入收藏夹');
			}
			
		}
	}

    
	

}
