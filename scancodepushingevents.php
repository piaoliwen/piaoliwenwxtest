<?php
	//创建菜单;
	public function create_menu($button,$matchrule = null){
		foreach ($button as &$item){
			foreach ($item as $k => $v) {
				if (is_array($v)) {
					foreach ($item[$k] as $subitem) {
						foreach ($subitem as $k2 => $v2) {
							$subitem[$k2]=urlencode($v2);
						}
					}
						
				}else{
					$item[$k]=urlencode($v);
				}
			}
		}
	
		if (isset($matchrule)&& !is_null($matchrule)){
			foreach ($matchrule as $k => $v) {
				$matchrule[$k] = urlencode($v);
			}
			$data = urldecode(json_encode(array('button'=>$button,'matchrule'=>$matchrule)));
			$url ="https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=".$this->access_token;
		}else{		
			$data = urldecode(json_encode(array('button'=>$button)));
			$url ="https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=".$this->access_token;
		}
		$res = $this->http_request($url,$data);
		return json_decode($res,true);
	}

	$weixin = new class_weixin();

	$button[] = array('type'=>"scancode_waitmsg",'name'=>"扫码快递",'key'=>"rselfmenu_2_1");
