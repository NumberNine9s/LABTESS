<?php
$access_token = 'lhh5bqVWFDXPY+cPsIeJrf9vC06L4SesNGP2SkzJjCdSgawBODTHK5tSZWjPiBytVm3QAkbOq8RAsIonUVszGz6Ok02qnDGZLKAtF3ltP9shw7EdD1FimHhpM/AzI1Bjvhbf0zu0TqEgOO7dBmSG9QdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
             $reply_message = $event['message']['text'];
             $reply_token = $event['replyToken'];
            $url = "https://dialogflow.cloud.google.com/v1/integrations/line/webhook/29f0ffe2-835f-480d-8410-2351e7e5ff17";
            $headers = getallheaders();
            $headers['Host'] = "bots.dialogflow.com";
            $json_headers = array();
            foreach ($headers as $k => $v) {
                $json_headers[] = $k . ":" . $v;
            }
              $inputJSON = file_get_contents('php://input');           
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $inputJSON);
              curl_setopt($ch, CURLOPT_HTTPHEADER, $json_headers);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              $result = curl_exec($ch);
              curl_close($ch);
              exit;
           /* 
            // Get text sent
            $text = $event['message']['text'];
            // Get replyToken
            $replyToken = $event['replyToken'];
            // Build message to reply back
            $messages = [
                'type' => 'text',
                'text' => $text,
            ];
            // Make a POST Request to Messaging API to reply to sender
         
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages]
            ];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            echo $result . "";    */      
        }            
    }
}
echo "OK";
