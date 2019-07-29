<?php

/**
 * 钉钉机器人开发文档
 * https://open-doc.dingtalk.com/microapp/serverapi2/qf2nxq
 */

// $valid_token = 'secret_token';
// $client_token = $_SERVER['HTTP_X_GITLAB_TOKEN'];
// $client_ip = $_SERVER['REMOTE_ADDR'];

// if ($client_token !== $valid_token) die('Token mismatch!'); 
// // exec("cd /var/www/html/; git pull origin master");
// //exec("cd /var/www/html/; git pull origin master 2>&1", $output);
// 上方代码示例为自定拉取git，自动化部署 


/**
 * @param message 发送的消息
 * @param token 指定机器人
 * @return {string}
 */

//  测试key
// 96b9bde460574078da29383139dc73248d64ee71f6d21c48c5a19869a9aa35ad
function hook($message, $token = "3f0a51b9b2e8b2c6e4637174d115a6b7c7e292ad4ab16b64cdd517e07644e175")
{
    if (!$message) {
        return false;
    }
    $string = json_encode(array('msgtype' => 'text', 'text' => array('content' => $message)));
    $remote_server = "https://oapi.dingtalk.com/robot/send?access_token=" . $token;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $remote_server);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
    // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); 
    // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    /**
     *	$data  字符串{"errcode":0,"errmsg":"ok"}；
     * https://open-doc.dingtalk.com/microapp/faquestions/rftpfg
     */
    return $data;
};
$rws_post = file_get_contents("php://input");
$mypost = json_decode($rws_post);
$msgtype = $mypost->msgtype;

// echo $rws_post;
// echo $msgtype;
// echo 2;
echo hook($mypost);
