<?php
class class_weixin
{
	var $appid = APPID;
	var $appsecret = APPSECRET;

	//构造函数，获取ACCESSTOKEN
	public function __construct($appid= null,$appsecret=null){
		if ($appid&&$appsecret) {
			$this->appid=$appid;
			$this->appsecre=$appsecret;
		}

		//方式1. 缓存形式
		if (isset($_SERVER['HTTP_APPNAME'])) {//sae环境 ，需要开通memcache
			$mem=memcache_init();
		}else{
			//本地环境需要安装memcache
			$mem = new Memcache;
			$mem->connect('localhost',11211) or die("Could not connect");
		}

		$this->access_token=$mem->get($this->appid);

		if (!isset($this->access_token)||empty($this->access_token)) {
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
			$res = $this->http_request($url);
			$result = json_decode($res,true);
			$this->access_token = $result["access_token"];
			$mem->set($this->appid,$this->access_token,0,3600);
		}
		//方法2.本地写入
		$res = file_get_contents('access_token.json');
		$result = json_decode($res,true);
		$this->expires_time = $result['expires_time'];
		$this->access_token = $result['access_token'];
		$callback_ip = $this->get_callback_ip();
		if (time()>($this->expires_time+3600)||!isset($callback_ip['ip_list'])) {
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
			$res = $this->http_request($url);
			$result = json_decode($res,true);
			$this->access_token = $result["access_token"];
			$this->expires_time = time();
			file_put_contents('access_token.json', '{"access_token":"'.$this->access_token.'","expires_time":'.$this->expires_time.'}');
		}
	}
	protected function http_request($url,$data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL,$url);
		
	}

}