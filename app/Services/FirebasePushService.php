<?php

namespace App\Services;

use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;

/**
 * Цей клас є прикладом відправки пуш нотифікацій, використовуючи Firebase.
 * Якщо ви збираєтесь використовувати даний функціонал для комерційних проектів - його слід оптимізувати.
 */
class FirebasePushService
{
    private Messaging $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function fbSinglePush(string $deviceToken): array
    {
        $message = CloudMessage::fromArray([
            'token' => $deviceToken,
            'notification' => [
                'title' => 'TITLE',
                'body' => 'FbSinglePush',
                'image' => 'https://stage.s3.eu-central-1###'
            ]
        ]);

        return $this->messaging->send($message);
    }

    public function fbMultiplePush(array $deviceTokens): Messaging\MulticastSendReport
    {
        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => 'TITLE',
                'body' => 'FbMultiplePush'
            ]
        ]);

        return $this->messaging->sendMulticast($message, $deviceTokens);
    }

    public function fbSendAllPush(string $deviceToken): Messaging\MulticastSendReport
    {
        $messages[] = [
            'notification' => [
                'title' => 'TITLE',
                'body' => '5% off all'
            ],
            'token' => $deviceToken
        ];

        $messages[] = [
            'notification' => [
                'title' => 'TITLE',
                'body' => '10% off all'
            ],
            'topic' => 'premium-users'
        ];

        return $this->messaging->sendAll($messages);
    }

    public function fbPushToTopic(string $topic): array
    {
        $message = CloudMessage::fromArray([
            'topic' => $topic,
            'notification' => [
                'title' => 'TITLE',
                'body' => 'FbPushToTopic'
            ]
        ]);

        return $this->messaging->send($message);
    }
}
