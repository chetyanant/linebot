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
            case 'ทักทาย':
                $respMessage = 'สวัสดีครับ GT-Bot
                ยินดีให้บริการข้อมูลสารสนเทศ
                ของสำนักงานแม่กองธรรมฯ
                ในหมวดของข้อมูลทั่วไป
                การสมัครเรียน-สอบธรรมะ
                ผลการสอบปี 2556-ปัจจุบัน
                E-Learning
                และมีการแจ้งเตือนกิจกรรมสำคัญต่างๆ
                ';
            break;
            case 'อยากเรียนธรรมะ จะไปเรียนที่ไหนได้บ้างคะ':
                $respMessage = 'ท่านสามารถเลือกสถานที่เรียนธรรมะได้ตามความสะดวกของตัวท่าน ตามรายชื่อต่อไปนี้ >>>
                https://www.dhammastudy.org/snr
                ';
            break;
			case 'สอบนักธรรมวันไหน':
                $respMessage = 'นักธรรมชั้นตรี สอบวันที่ ๒๖ - ๒๙ กันยายน ๒๕๖๓ ส่วนนักธรรมชั้นโท-เอก สอบวันที่ ๒ - ๕ พฤศจิกายน ๒๕๖๓';
            break;
            case 'กำหนดสอบ, สอบวันไหน':
                $respMessage = 'กำหนดสอบธรรมสนามหลวง คลิ๊ก >> http://www.gongtham.net/web/news.php';
            break;
			case 'สอบธรรมศึกษาวันไหน';
			    $respMessage = 'ธรรมศึกษา สอบวันพฤหัสบดีที่ ๒๔ ธันวาคม ๒๕๖๓ ส่วน กศน.,อุดมศึกษาและประชาชนทั่วไปบางส่วน สอบวันอาทิตย์ที่ ๒๗ ธันวาคม ๒๕๖๓';
			break;
			case 'ขอทราบผลสอบค่ะ';
			    $respMessage = 'ผลสอบปีไหนครับ';
			break;
			case '2562';
			    $respMessage = 'กรุณาพิมพ์เลขประจำตัวประชาชน 13 หลักของท่านครับ';
			break;
            case 'ใบคำร้อง';
                $respMessage = 'ดาวน์โหลดใบคำร้อง คลิ๊ก >> http://www.gongtham.net/web/downloads.php?cat_id=5&download_id=80';
            break;

        // ส่วนของผลสอบ
			case '1111111111111';
                $respMessage = "ชื่อ: ชนากานต์
นามสกุล: xxxxx
รร.: วัดสวนส้ม(สุขประนุกูล)
สนร.: วัดมหาธาตุยุวราชรังสฤษฎิ์
สอบได้: ธรรมศึกษาชั้นตรี
ปกศ.เลขที่: กท ๑๔๑๖๒/xxxxx
พ.ศ.2562";
			break;
			case '1111111111112';
			    $respMessage = 'ชื่อ: ณธิดา 
นามสกุล: xxxxx
รร.: สุขฤทัย
สนร.: วัดมหาธาตุยุวราชรังสฤษฎิ์
สอบได้: ธรรมศึกษาชั้นตรี
ปกศ.เลขที่: กท ๑๔๑๖๒/xxxxx
พ.ศ.2562';
			break;
			case 'วัดมหาธาตุ';
			    $respMessage = 'กรุณากดที่ลิงค์ >>> http://www.gongtham.net/passlist/?search=2562วัดมหาธาตุ';
            break;
            
		// กรณีพิมพ์ข้อความผิด
			case 'จะรู้ผลสอลเมื่อไร';
			    $respMessage = 'กองธรรมจะประกาศผลสอบผ่านทางเว็บไซต์ www.gongtham.net ในวันที่ 11 มกราคม 2564 ครับ';
            break;
            case '';
			    $respMessage = '';
            break;
        // กรณีพิมพ์ข้อความยาว
            case 'อยากทราบวันกำหนดส่งสอบธรรมสนามหลวงประจำปีการศึกษา 2563 ครับผมเผื่อจะได้ดำเนินการ';
                $respMessage = 'นักธรรมชั้นตรี สอบวันที่ ๒๖ - ๒๙ กันยายน ๒๕๖๓ ส่วนนักธรรมชั้นโท-เอก สอบวันที่ ๒ - ๕ พฤศจิกายน ๒๕๖๓
ธรรมศึกษา สอบวันพฤหัสบดีที่ ๒๔ ธันวาคม ๒๕๖๓ ส่วน กศน.,อุดมศึกษาและประชาชนทั่วไปบางส่วน สอบวันอาทิตย์ที่ ๒๗ ธันวาคม ๒๕๖๓';
            break;
            case 'ในกรณีที่สอบผ่านนักธรรมแล้ว แต่ชื่อผิด มีแนวทางแก้ไขไหมครับ';
			    $respMessage = 'รีบติดต่อเจ้าหน้าที่กองธรรมภายใน 30 วัน นับจากวันประกาศผลสอบ';
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