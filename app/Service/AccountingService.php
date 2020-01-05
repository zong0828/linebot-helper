<?php
namespace App\Service;

use Illuminate\Support\Collection;
use App\Service\Repository\UserRepository;
use Log;
use App\Service\Resource\LineBot;

/**
 * AccountingService class
 * process line request adapter
 */
class AccountingService
{

    private $lineBot;

    const DEFAULT_MESSAGE = '您好，該服務尚未提供';

    /**
     * __construct
     *
     * @param object $lineBot linebot object
     *
     * @return void
     */
    public function __construct($lineBot = null)
    {
        if (empty($lineBot)) {
            throw new \Exception('system error');
        }

        $this->lineBot = $lineBot;
    }

    /**
     * 整理 user message
     *
     * @return void
     */
    public function getMessage($lineWebhook)
    {
        if (empty($lineWebhook)) {
            throw new \Exception('line web hook missing');
        }

        $userMessage = [];

        foreach ($lineWebhook['events'] as $key => $event) {
            // message
            if ($event['type'] === 'message' && $event['source']['type'] === 'user') {
                $info = [
                    'type'        => $event['type'],
                    'replyToken'  => $event['replyToken'],
                    'userId'      => $event['source']['userId'],
                    'userName'    => $this->getUserInfo($event['source']['userId']),
                    'messageType' => $event['message']['type'],
                    'message'     => $event['message']['text']
                ];

                $userMessage = $info;
            }
        }

        return self::DEFAULT_MESSAGE;
    }

    private function getUserInfo($userId, $LineBot = null)
    {
        if (empty($userId)) {
            throw new \Exception('empty user id');
        }

        $user = UserRepository::get($userId);

        if (empty($user)) {
            $lineUser = $this->lineBot->getProfile($userId);
            UserRepository::create([
                'name'    => $lineUser['displayName'],
                'line_id' => $userId
            ]);

            $user = UserRepository::get($userId);
        }

        return $user;
    }

    private function getResponseMessage($messageInfo)
    {

    }
}
