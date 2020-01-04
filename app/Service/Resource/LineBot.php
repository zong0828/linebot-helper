<?php
namespace App\Service\Resource;

use Log;
use Ixudra\Curl\Facades\Curl;

/**
 * Linebot class
 */
class LineBot
{
    private $bot;
    private $botUrl;
    private $accessToken;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct($accessToken, $secret)
    {
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($accessToken);
        $this->bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);
        $this->botUrl = env('LINE_BOT_URL');
        $this->accessToken = $accessToken;
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

    /**
     * 取得 user name
     *
     * @param string $userId
     * @return array
     */
    public function getProfile($userId)
    {
        $authorization = "Authorization: Bearer {$this->accessToken}";
        $url = $this->botUrl . "/profile" . "/{$userId}";

        $response = Curl::to($url)->withHeader($authorization)->get();

        Log::info($response);
        $lineUser = json_decode($response, true);

        if (empty($lineUser['displayName'])) {
            Log::info('miss display name');
            throw new \Exception('miss displayName');
        }

        return $lineUser;
    }
}
