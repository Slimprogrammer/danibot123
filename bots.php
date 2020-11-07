
<?php
$token = "988489265:AAHOZbQBg-LpKo2Vtbaux1S7lHimLxt5mlg";
$website = "https://api.telegram.org/bot".$token;
$web = "https://api.telegram.org/file/bot".$token;

$update = json_decode(file_get_contents('php://input'),TRUE);
//$db = new DatabaseUtility();
//$db->insert_update($update['update_id'], json_encode($update));
if(isset($update['callback_query']))
{
    $chatID = $update['callback_query']['message']['chat']['id'];
    $messageID = $update['callback_query']['message']['message_id'];
    $username = $update['callback_query']['from']['username'];
    $text = "edited text";
    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => 'forward me to groups2', 'callback_data' => 'someString2']
            ]
        ]
    ];
    $encodedKeyboard = json_encode($keyboard);
    $parameters =
        array(
            'chat_id' => $chatID,
            'message_id' => $messageID,
            'text' => $text,
            'reply_markup' => $encodedKeyboard
        );




    $url = $GLOBALS['website'].'/editMessageReplyMarkup?'.http_build_query($parameters);
    file_get_contents($url);

}
elseif(isset($update['message']))
{

    $chatID = $update['message']['from']['id'];
    $firstname = $update['message']['from']['first_name'];
    $username = $update['message']['from']['username'];
    $text = $update['message']['text'];

    switch($text)
    {
        case"/start":
            sendMessage($chatID, "Hi $username");
            break;
        case"/hello":
            sendMessage($chatID, "Hello $firstname");
            break;
        case"/key":
            sendKeyboard($chatID, "Hello $firstname");
            break;
        default:
            sendMessage($chatID, json_encode($update));
            break;
    }
}


function sendMessage($chatID, $text)
{
    $parameters = array(
        'chat_id' => $chatID,
        'text' => $text
    );

    $url = $GLOBALS['website'].'/sendMessage?'.http_build_query($parameters);

    file_get_contents($url);
}
function sendKeyboard($chatID, $text)
{
    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => 'forward me to groups', 'callback_data' => 'someString']
            ]
        ]
    ];
    $encodedKeyboard = json_encode($keyboard);
    $parameters =
        array(
            'chat_id' => $chatID,
            'text' => "Here's the weather in 2",
            'reply_markup' => $encodedKeyboard
        );


    $url = $GLOBALS['website'].'/sendMessage?'.http_build_query($parameters);

    file_get_contents($url);
}

?>