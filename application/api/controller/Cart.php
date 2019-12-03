<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
/**
 * 接口
 */
class Cart extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['*'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['*'];
	
	
	public function del(){
		if($this->request->isPost()){
			
			$post = $this->request->param();
			
			db::name('cart')->where(['id'=>$post['id']])->delete();
			$this->success('已删除');
		}
	}
	
	public function getList(){
		if($this->request->isPost()){
			
			$post = $this->request->param();
			
			$list = db::name('cart')->alias('c')
			->join('goods g', 'g.id = c.goods_id')
			->where(['c.uid' => $post['uid']])
			->field('c.id, c.goods_id, g.name, g.price, g.images')
			->select();
			
			foreach($list as $key => $val){
				$images = explode(',', $val['images']);
				$list[$key]['image'] = FILE_PATH . $images[0];
				$list[$key]['number'] = 1;
				$list[$key]['selected'] = false;
			}
			$this->success('ok', $list);
		}
	}
	
	public function add(){
		if($this->request->isPost()){
			
			$post = $this->request->param();
			
			$res = db::name('cart')->where($post)->find();
			if($res){
				db::name('cart')->where(['id'=>$res['id']])->update(['updatetime'=>time()]);
			}else{
				$post['createtime'] = time();
				$post['updatetime'] = time();
				db::name('cart')->insert($post);
			}
			$this->success('已加入购物车');
		}
	}

    
	

}
