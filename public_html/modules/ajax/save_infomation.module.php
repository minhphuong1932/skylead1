<?php
// By luan
include_once(ROOT_PATH.'classes/dao/information.class.php');
$information = new Information($storeId);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$name = $request->element('name');
$phone = $request->element('phone');
$email = $request->element('email');

if(!empty($name) && !empty($phone) && !empty($email)){
    if(strlen($phone) == 10 && preg_match("/^([0-9]+)$/",$phone) == 1 && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $data  = array(
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'status' => 1,
            'store_id' => $storeId,
            'date_created' => date("Y-m-d H:i:s"),
        );
        
        $newId = $information->addData($data);
        if($newId){
            if(!empty($estore->getEmail())){
                // $estore->getEmail()
                $emailAD = "hviettrinh112@gmail.com";
                $subject = $estore->getProperty('custom_title_email');
                $content = $estore->getProperty('custom_content_email');
                if($name){
                    $content .= "<p>Tên : ".$name."</p>";
                }
                if($phone){
                    $content .= "<p>Phone : ".$phone."</p>";
                }
                if($email){
                    $content .= "<p>Email : ".$email."</p>";
                }
                
                $content .= "<p>Trân trọng,</p>";
                $content .= "<p>Công Ty Skyled</p>";
                $To  = strip_tags($emailAD);
                $from   = SMTP_USER;
                $header = "Content-type: text/html; charset=utf-8\r\nFrom: $from\r\nReply-to: $from";
                require_once(ROOT_PATH.'classes/PHPMailer/class.phpmailer.php');
                $mail = new PHPMailer();
                $mail->CharSet = 'UTF-8';
                $mail->XMailer = 'Derasoft Mailer';
                $mail->IsSMTP();
                // $mail->SMTPDebug  = 1;
                $mail->SMTPAuth = true;
                $mail->Host = SMTP_HOST;            
                $mail->Port = SMTP_PORT;           
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASSWORD; 
                $mail->IsHTML(true);
                $mail->Subject = $subject." (No.".strtotime(date("Y-m-d H:i:s")).")"; // subject là tiêu đề
                $body = $content;// $body là nội dung lấy từ cấu hình                        
                $mail->MsgHTML($body);            
                $mail->AddAddress($To);// to là email người nhận
                $mail->SetFrom($from,'Công Ty Skyled'); 
                if(!$mail->Send()) 
                {                
                    // exit(json_encode(["error"=>1,"message"=>$mail->ErrorInfo]));                
                } 
            }
        }
        $success = 1;
    }
}

$result=array("success" => $success);
echo json_encode($result);

?>