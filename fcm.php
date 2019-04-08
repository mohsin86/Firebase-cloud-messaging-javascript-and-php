<?php
/*  
Parameter Example
	$data = array('post_id'=>'12345','post_title'=>'A Blog post');
	$target = 'single tocken id or topic name';
	or
	$target = array('token1','token2','...'); // up to 1000 in one request
*/

class FCM
{

    //FCM api URL
    private $url = 'https://fcm.googleapis.com/fcm/send';
    //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
    private  $server_key = 'PASTE_YOUR_SERVER_KEY_HERE';


    public function sendMessage($data, $target_device_token)
    {

        $fields = array();
        $fields['data'] = $data;

        if (is_array($target_device_token)) {
            $fields['registration_ids'] = $target_device_token;
        } else {
            $fields['to'] = $target_device_token;
        }

        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $this->server_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}

$fcm = new FCM();
$data = [
    'message' => 'Your Message',
    'title' => 'Yout tittle',
    'body' => $message,
    'subtitle' => 'This is a subtitle. subtitle',
    'tickerText' => 'Update Status:' . $delivery_status,
    'vibrate' => 1,
    'sound' => 1,
    'largeIcon' => 'large_icon',
    'smallIcon' => 'small_icon'

];
$target_device_token = 'YOUR_DEVICE_TOKEN';
$success = $fcm->sendMessage($data, $target_device_token);
var_dump($success);