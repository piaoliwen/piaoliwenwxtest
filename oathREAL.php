class weixin{

	var $appid = APPID;
	var $appsecret = APPSECRET;
	public function __construct($appid = null,$appsecret = null)
    {
		if($appid && $appsecret){
			$this->appid = $appid;
			$this->appsecret = $appsecret;

		}
	}

	//生成OAuth2.0的url
	public function oath2_authorize($redirect_url,$scope,$state=null)
    {
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."$redirect_url=".$redirect_url."&response_type=code&scope".$this->scope."&state=".$state."#wechat_redirect";
		return $url;
	}
	//生成OAuth2.0的Access Token
	public function oauth2_access_token($code){
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".this->$appid."&secret=".$this->appsecret."&code=".$code."&grant_type=authorization_code";
		$res = $this->http_request($url);
		return json_decode($res,true);
	}
	//获取用户基本信息
	public function oauth2_get_user_info($access_token, $openid){
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token".$access_token."&openid=".&openid."&lang=zh_CN";
		$res = $this->http_request($url);
		return json_decode($res,true);
	}
	//HTTP请求
	protected function http_request($url,$data=null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURL_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output=curl_exec($curl);
		return $output;
	}
}