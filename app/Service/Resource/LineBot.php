<?php
namespace App\Service\Resource;

use Log;

/**
 * Linebot class
 */
class LineBot
{
    private $bot;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct($access_token, $secret)
    {
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
        $this->bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);
    }

    /**
     * response text format
     *
     * @param string $message
     * @return void
     */
    public function textResponse($replyToken, $message = '')
    {
        $response = $this->bot->replyText($replyToken, 'hi');

        if ($response->isSucceeded()) {
            Log::info('success');
            return;
        }

        // Failed
        Log::info(json_encode($response, JSON_UNESCAPED_UNICODE));
    }
}
