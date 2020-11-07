<?php
$token = "988489265:AAHOZbQBg-LpKo2Vtbaux1S7lHimLxt5mlg";
$website = "https://api.telegram.org/bot".$token;
$web = "https://api.telegram.org/file/bot".$token;

$update = json_decode(file_get_contents('php://input'),TRUE);
$chatID = $update['message']['from']['id'];
$fname = $update['message']['from']['first_name'];
$username = $update['message']['from']['username'];
$text = $update['message']['text'];

$db = new DatabaseUtility();
//$db->insert_update($update['update_id'], json_encode($update));
sendMessage($chatID, $db->get_Table("SELECT * FROM Updates"));
function sendMessage($chatID, $text)
{
    $parameters = array(
        'chat_id' => $chatID,
        'text' => $text
    );

    $url = $GLOBALS['website'].'/sendMessage?'.http_build_query($parameters);

    file_get_contents($url);
}

?>