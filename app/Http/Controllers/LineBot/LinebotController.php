<?php

namespace App\Http\Controllers\LineBot;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class LinebotController extends BaseController
{
    /**
     * line bot construct
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function mainAction(Request $request)
    {
        // TODO 驗證數位簽章 header
        $lineRequest = $request->all();

        $replyToken = $lineRequest['events'][0]['replyToken'];

        // line settting
        $access_token = env('LINE_ACCESS_TOKEN');
        $secret = env('LINE_SECRET');

        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);
        // $response = $bot->replyText($replyToken, 'hello!');
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        if ($response->isSucceeded()) {
            echo 'Succeeded!';
            return;
        }

        // Failed
        echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }

    public function test()
    {
        echo "mytest";
    }
}