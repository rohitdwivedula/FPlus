<?php
    require_once('client.php');
    /**
     * Send email via GMail API
     * @param to        the recepient of the email
     * @param subject   subject of the email
     * @param message   body of the email
     */
    function send($to, $subject, $message){
        $client = getClient();
        $service = new Google_Service_Gmail($client);
        // Process data
        try {
            $strRawMessage = "From: "."FPlus Inc<fplus@fplus.localhost.com>"."\r\n";
            $strRawMessage .= ("To: <" . $to . ">\r\n");
            $strRawMessage .= "Subject: =?utf-8?B?" . base64_encode($subject) . "?=\r\n";
            $strRawMessage .= "MIME-Version: 1.0\r\n";
            $strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
            $strRawMessage .= "Content-Transfer-Encoding: base64" . "\r\n\r\n";
            $strRawMessage .= $message;
            // The message needs to be encoded in Base64URL
            $mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
            $msg = new Google_Service_Gmail_Message();
            $msg->setRaw($mime);
            //The special value **me** can be used to indicate the authenticated user.
            $service->users_messages->send("me", $msg);
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
        }
    }
?>