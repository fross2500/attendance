<?php
require 'vender/autoload.php';

class SendEmail{

    public static function SendMail($to,$subject,$content){
        
    $key = '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';

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("rowellfross@gmail.com", "Rowell Fross");
    $email->setSubject($subject);
    $email->addTo($to);
    $email->addContent("text/plain", $content);

    $sendgrid = new \SendGrid($key);

    try {
        $response = $sendgrid->send($email);
        return $response;
    } catch (Exception $e) {
        echo 'Email exception Caught : '. $e->getMessage() . "\n";
        return false;
        //throw $th;
    }

    }
}


?>