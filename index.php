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
    ไม่ว่าจะเป็นข้อมูลทั่วไป
    การสมัครเรียน-สอบธรรมะ
    การขอเปิดสนามสอบ
    ผลการสอบปี 2558-ปัจจุบัน
    E-Learning
    และการแจ้งเตือนกิจกรรมสำคัญต่างๆ
    .....
    ท่านสามารถพิมพ์สนทนา/สอบถาม
    กับ GT-Bot ได้ตามปกติ
    เสมือนคุยกับบุคลากรของกองธรรม
    เช่น จะสอบธรรมะวันไหน
    เปิดรับสมัครสอบเมื่อใด
    เข้าระบบสมัครสอบได้ยังไง
    ยังไม่ได้รับใบประกาศนียบัตรจะต้องทำอย่างไร ฯลฯ
    .....';
            break;
            case 'อยากเรียนธรรมะ จะไปเรียนที่ไหนได้บ้างคะ':
                $respMessage = 'ท่านสามารถเลือกสถานที่เรียนธรรมะได้ตามความสะดวกของตัวท่าน ตามรายชื่อต่อไปนี้ >>>
                https://www.dhammastudy.org/snr
                ';
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
			case 'ขอทราบผลสอบค่ะ';
			    $respMessage = 'ผลสอบปีไหนครับ';
			break;
			case '2562';
			    $respMessage = 'กรุณาพิมพ์เลขประจำตัวประชาชน 13 หลักของท่านครับ';
			break;
            case 'ใบคำร้อง';
                $respMessage = 'ดาวน์โหลดใบคำร้อง คลิ๊ก >> http://www.gongtham.net/web/downloads.php?cat_id=5&download_id=80';
            break;

        // ริชเมนู
        case 'ดูผลสอบ';
            $respMessage = "ท่านสามารถค้นดูผลสอบได้ 3 วิธี
โดยต้องพิมพ์ตามรูปแบบ ดังนี้เท่านั้น
วิธีที่ 1 ค้นด้วยชื่อ-สกุล ให้พิมพ์ว่า
            [ชื่อ-สกุล]สมหมาย ชายไทย
วิธีที่ 2 ค้นด้วยเลข ปชช.13 หลัก ให้พิมพ์ว่า
            [id]1234567891011
วิธีที่ 3 ค้นด้วยชื่อองค์กร/สถานศึกษา ให้พิมพ์ว่า
            [sc]โรงเรียนวัดบวร
**ข้อสังเกต ทุกวิธีจะต้องมีคำเฉพาะที่อยู่ใน [ ] แล้วตามด้วยชื่อ สกุล หรือ เลข ปชช. หรือชื่อองค์กรสถานศึกษา
            ";
            break;


        // ส่วนของผลสอบ
        case '[ชื่อ]เรืองยศ';
            $respMessage = "ผลการสืบค้น https://www.dhammastudy.org/passexam?pass_id=เรืองยศ";
            break;
        case '[สกุล]จุฬานนท์';
            $respMessage = "ผลการสืบค้น https://www.dhammastudy.org/passexam?pass_id=จุฬานนท์";
            break;
        case '[ชื่อ-สกุล]ปิยธิดา ภูวันเพ็ง';
            $respMessage = "ผลการสืบค้น https://www.dhammastudy.org/passexam?pass_id=ปิยธิดา-ภูวันเพ็ง";
            break;
        case '[id]1234567891011';
            $respMessage = "ผลการสืบค้น https://www.dhammastudy.org/passexam?pass_id=1234567891011";
            break;
        case '[sc]โรงเรียนผ่องพลอยอนุสรณ์';
            $respMessage = "ผลการสืบค้น https://www.dhammastudy.org/passexam?pass_id=โรงเรียนผ่องพลอยอนุสรณ์";
            break;
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
        // ส่วนของผลสอบ ที่สอบไม่ผ่าน
        case '1212121212121';
            $respMessage = ':(__ขอแสดงความเสียใจด้วยครับ__:(
ผู้เข้าสอบหมายเลข ปชช. นี้
ยังสอบไม่ผ่านชั้นใดเลย
ขอให้ท่านพยามอีกนิด
GT-Bot ขอเอาใจช่วยครับ ^_^
.....';
            break;
			case 'วัดมหาธาตุ';
			    $respMessage = 'กรุณากดที่ลิงค์ >>> http://www.gongtham.net/passlist/?search=2562วัดมหาธาตุ';
            break;
            
		// กรณีพิมพ์ข้อความผิด
			case 'จะรู้ผลสอลได้ตอไหน';
			    $respMessage = 'กองธรรมจะประกาศผลสอบผ่านทางเว็บไซต์ www.gongtham.net ในวันที่ 11 มกราคม 2564 ครับ';
            break;
        // กรณีพิมพ์ข้อความยาว
            case 'อยากทราบวันกำหนดส่งสอบธรรมสนามหลวงประจำปีการศึกษา 2563 ครับผมเผื่อจะได้ดำเนินการ';
                $respMessage = 'นักธรรมชั้นตรี สอบวันที่ ๒๖ - ๒๙ กันยายน ๒๕๖๓ ส่วนนักธรรมชั้นโท-เอก สอบวันที่ ๒ - ๕ พฤศจิกายน ๒๕๖๓
ธรรมศึกษา สอบวันพฤหัสบดีที่ ๒๔ ธันวาคม ๒๕๖๓ ส่วน กศน.,อุดมศึกษาและประชาชนทั่วไปบางส่วน สอบวันอาทิตย์ที่ ๒๗ ธันวาคม ๒๕๖๓';
            break;
            case 'ในกรณีที่สอบผ่านนักธรรมแล้ว แต่ชื่อผิด มีแนวทางแก้ไขไหมครับ';
			    $respMessage = 'รีบติดต่อเจ้าหน้าที่กองธรรมภายใน 30 วัน นับจากวันประกาศผลสอบ';
            break;
        // กรณีที่ไม่เข้าใจข้อความ
            case 'ที่สนามสอบธรรมศึกษาที่เชียงใหม่มีอาหารเลี้ยงป่าวครับ';
                $respMessage = 'ขออภัย GT-Bot ไม่เข้าใจคำสนทนาของท่าน
กรุณาใช้คำสนทนาใหม่ หรือใช้คำจำกัดความที่เข้าใจได้ง่ายด้วยครับ';
            break;
        // การแจ้งเตือนกิจกรรมสำคัญ
            case 'เตือนความจำ';
                $respMessage = '!!! ***ประกาศ***
สำนักงานแม่กองธรรมสนามหลวง
จะเปิดระบบให้สมัครสอบได้
ตั้งแต่วันที่ 1 พฤศจิกายน 2563
ถึง 4 ธันวาคม 2563
ขอให้ท่านผู้ดูแลการสมัครสอบ
และผู้ที่จะสมัครเข้าสอบ
เตรียมตัวกันให้พร้อมนะครับ ';
            break;
            
            case '';
            $respMessage = '';
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