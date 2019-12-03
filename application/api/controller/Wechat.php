<?php

namespace app\api\controller;

use app\common\controller\Api;

/**
 * 接口
 */
class Wechat extends Api {
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];
	
	public $appid = 'wx370d0f595f75aff2';
	public $redirect_uri = 'http://www.culiu.xyz/api/wechat/getToken';
	
    
	public function getCode(){
		$this->redirect_uri = urlencode($this->redirect_uri);
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid . "&redirect_uri=". $this->redirect_uri ."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
		echo $url;
	}
	
	
	public function getToken(){
		$post = $this->request->param();
		echo '<pre>'; print_r($post);
	}
	
}
