<?php
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
			case 'สวัสดี':
                            $respMessage = 'สวัสดีครับ';
                        break;
			case 'สอบนักธรรมวันไหน':
                            $respMessage = 'นักธรรมชั้นตรี สอบวันที่ ๒๖ - ๒๙ กันยายน ๒๕๖๓ ส่วนนักธรรมชั้นโท-เอก สอบวันที่ ๒ - ๕ พฤศจิกายน ๒๕๖๓';
                        break;
                        case 'กำหนดสอบ':
                            $respMessage = 'กำหนดสอบธรรมสนามหลวง คลิ๊ก >> http://www.gongtham.net/web/news.php';
                        break;
			case 'สอบธรรมศึกษาวันไหน';
			    $respMessage = 'ธรรมศึกษา สอบวันพฤหัสบดีที่ ๒๔ ธันวาคม ๒๕๖๓ ส่วน กศน.,อุดมศึกษาและประชาชนทั่วไปบางส่วน สอบวันอาทิตย์ที่ ๒๗ ธันวาคม ๒๕๖๓';
			break;
			case 'ขอทราบผลสอบ';
			    $respMessage = 'ผลสอบปีไหนครับ';
			break;
			case '2562';
			    $respMessage = 'กรุณาพิมพ์ตัวเลข 4 หลักสุดท้ายของเลขประจำตัวประชาชนของท่านครับ';
			break;
                        case 'ใบคำร้อง':
                            $respMessage = 'ดาวน์โหลดใบคำร้อง คลิ๊ก >> http://www.gongtham.net/web/downloads.php?cat_id=5&download_id=80';
                        break;
		// ส่วนของผลสอบ
			case '8877';
			    $respMessage = 'ชื่อ: ชนากานต์ นามสกุล: โชติประเสริฐ รร.: วัดสวนส้ม(สุขประนุกูล) สำนักเรียน: วัดมหาธาตุยุวราชรังสฤษฎิ์ สอบได้: ธรรมศึกษาชั้นตรี ปกศ.เลขที่: กท ๑๔๑๖๒/๐๐๑๐๕ พ.ศ.2562';
			break;
			case '3945';
			    $respMessage = 'ชื่อ: ณธิดา'<br>'นามสกุล: ลีนะเสน '<br>' รร.: สุขฤทัย '<br>' สำนักเรียน: วัดมหาธาตุยุวราชรังสฤษฎิ์ '<br>' สอบได้: ธรรมศึกษาชั้นตรี '<br>' ปกศ.เลขที่: กท ๑๔๑๖๒/๐๐๒๒๒ '<br>' พ.ศ.2562';
			break;
			case '';
			    $respMessage = '';
			break;
		// กรณ๊พิมพ์ข้อความผิด
			case 'จะรู้ผลสอลเมื่อไร';
			    $respMessage = 'กองธรรมจะประกาศผลสอบผ่านทางเว็บไซต์ www.gongtham.net ในวันที่ 11 มกราคม 2564 ครับ';
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
