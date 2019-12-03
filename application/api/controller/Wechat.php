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
	public $redirect_uri = '';
	
    
	public function getCode(){
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid . "&redirect_uri=". $this->redirect_uri ."&response_type=code&scope=SCOPE&state=STATE#wechat_redirect";
	}
	
	
	public function requestUser(){
		
	}
	
}
