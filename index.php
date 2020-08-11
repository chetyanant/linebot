<?php
/*
Name : Schedule Line Bot
Feature
    - ถามตารางงาน
        ขอตารางงาน มกราคม
        bot-return : รายงานของเดือนมกราคม
        ลักษณะการตอบกลับ
            12/01/2562 12:00 ประชุมวิชาการ
            15/01/2562 12:00 ประชุมวิชาการ
*/
/*
 {
  "events": [
      {
        "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",
        "type": "message",
        "timestamp": 1462629479859,
        "source": {
             "type": "user",
             "userId": "U206d25c2ea6bd87c17655609a1c37cb8"
         },
         "message": {
             "id": "325708",
             "type": "text",
             "text": "Hello, world"
          }
      }
  ]
}
 */

require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

// Token
$channel_token = 'TBQw9ccESvmiR6bxmUvXXlbLyRfJdXV6tjczChHP/OjGp7hDRBApw0TmJ6xMPhCXv7iywr1OGuf8z5tYmKzwBwoMz4UdwT/DMO1vxa2+mVpVQ3kIwAT2/uAqs8Q0/AV0cOjbQ4ZnQQK3oqEWA1S5XwdB04t89/1O/w1cDnyilFU=';
$channel_secret = '8e0040c9cf29e1724558c683fa929bc1';

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

	// Loop through each event
	foreach ($events['events'] as $event) {
    
        // Line API send a lot of event type, we interested in message only.
		if ($event['type'] == 'message') {

            switch($event['message']['type']) {
                
                case 'text':
                    // Get replyToken
                    $replyToken = $event['replyToken'];
   
                    // Reply message
                    $respMessage = ''. $event['message']['text'];
                    
                    $userText = ''. $event['message']['text'];
                    switch($userText){
                        case 'กำหนดสอบ':
                            $respMessage = 'กำหนดสอบธรรมสนามหลวง คลิ๊ก >>
                            http://www.gongtham.net/web/news.php';
                        break;

                        case 'ใบคำร้อง':
                            $respMessage = 'ดาวน์โหลดใบคำร้อง คลิ๊ก >>
                            http://www.gongtham.net/web/downloads.php?cat_id=5&download_id=80';
                        break;

                    }
                    
                    // if($event['message']['text'] == "กำหนดสอบ"){
                    //     $respMessage = "กำหนดสอบธรรมสนามหลวง คลิ๊ก >>
                    //     http://www.gongtham.net/web/news.php";

                    // }elseif($event['message']['text'] == "ขอใบประกาศ"){
                    //     $respMessage = "ดาวน์โหลดใบคำร้อง คลิ๊ก >>
                    //     http://www.gongtham.net/web/downloads.php?cat_id=5&download_id=80";

                    // }elseif($event['message']['text'] == ""){
                    //     $respMessage = ''. $event['message']['text'];
                    // }else{
                    //     $respMessage = 'ติดต่อเจ้าหน้าที่ โทร. ...';
                    // }
                                
                    $httpClient = new CurlHTTPClient($channel_token);
                    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
        
                    $textMessageBuilder = new TextMessageBuilder($respMessage);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
                    
                    // break;
            }
		}
	}
}

echo "Hello LINEBot";