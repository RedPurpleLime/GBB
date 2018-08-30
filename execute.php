<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);  //tolgo gli spazi iniziali e finali
$text = strtolower($text); //rendo tutto minuscolo
//$text = (str_replace(" ", "", $text)); //elimino gli spazi

header("Content-Type: application/json");

$response = '';

if(strpos($text, "/start") === 0 || $text=="ciao")
{
	$response = "Ciao $firstname, benvenuto nel GearBOSS-BOT!";
}
elseif (strstr($text,"random") == TRUE)
{
	$response = "risposta per random";
}
elseif((strstr($text,"hitech") == TRUE)
{
	$response = "risposta per hi-tech";
}
elseif((strstr($text,"lalla") == TRUE)
{
	$response = "La più bella della galassia! <3 ";
}
else
{
//	$response = "Comando non valido!";
}

$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
