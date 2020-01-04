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
    /**
     * 整理 user message
     *
     * @return void
     */
    public function getUserMessage($lineWebhook)
    {
        if (empty($lineWebhook)) {
            Log::info('line web hook missing');
            throw new \Exception('line web hook missing');
        }

        $userMessage = [];

        foreach ($lineWebhook['events'] as $key => $event) {
            // message
            if ($event['type'] = 'message') {
                $info = [
                    'type'        => $event['type'],
                    'replyToken'  => $event['replyToken'],
                    'userId'      => $event['source']['userId'],
                    'messageType' => $event['message']['type'],
                    'message'     => $event['message']['text']
                ];

                $userMessage = $info;
            }
        }

        return $userMessage;
    }

    public function getUserInfo($userId, $LineBot = null)
    {
        if (empty($userId)) {
            Log::info('empty user Id');
            throw new \Exception('empty user id');
        }

        $user = UserRepository::get($userId);

        if (empty($user) && !empty($LineBot)) {
            $lineUser = $LineBot->getProfile($userId);
            UserRepository::create([
                'name'    => $lineUser['displayName'],
                'line_id' => $userId
            ]);

            $user = UserRepository::get($userId);
        }

        return $user;
    }
}
