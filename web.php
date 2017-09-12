<?php
/**
 * Created by PhpStorm.
 * User: kevinpark
 * Date: 2017/9/12
 * Time: 9:35
 */


require_once ('www.php');
$weixin = new www();

if(!@isset($_GET['code'])){
    $redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $jumpurl = $weixin->oath2_authorize($redirect_url,"snsapi_userinfo","123");
    Header("Location:$jumpurl");

}else{
    $access_token_oauth2 = $weixin->oauth2_access_token($_GET['code']);
    $userinfo = $weixin->oauth2_get_user_info($access_token_oauth2['access_token'],$access_token_oauth2['openid']);

}
?>
<!DOCTYPE html>
<head lang="zh-cn">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>网页授权DEMO</title>

</head>
<body>
<?php echo $userinfo["openid"]; ?>
<img src ="<?php echo str_replace("0/","46/",$userinfo['headimgurl']); ?>">
<?php echo $userinfo["nickname"]; ?>
</body>
</html>
