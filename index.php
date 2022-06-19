<?php

function skill_vezdekod($request_message)
{
    $isEkivoki = false;
    $isVezdekod = false;
    foreach ($request_message['request']['nlu']['tokens'] as $token) {
        if (strcmp($token, 'экивоки')) $isEkivoki = true;
        if (strcmp($token, 'вездекод')) $isVezdekod = true;
    }

    if ($isEkivoki and $isVezdekod) {
        $text = 'Привет вездекодерам!';
        $tts = 'Прив`ет вездек`одерам!';
    }
    else {
        $text = 'Не понимаю ваш запрос';
        $tts = 'Не поним`аю ваш запр`ос';
    }
    return [
        'response' => [
            'text' => $text,
            'tts' => $tts,
            'end_session' => FALSE
        ],
        'session' => [
            'user_id' => $request_message['session']['user_id'],
            'session_id' => $request_message['session']['session_id'],
            'message_id' => $request_message['session']['message_id']
        ],
        'version' => $request_message['version']
    ];;
}

$request_message = json_decode(file_get_contents('php://input'), true);
$response_message = skill_vezdekod($request_message);

header('Content-Type: application/json');

$response_message['response']['end_session'] = true;
echo json_encode($response_message);