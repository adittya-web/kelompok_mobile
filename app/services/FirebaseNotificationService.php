<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Factory;

class FirebaseNotificationService
{
    private Messaging $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $this->messaging = $factory->createMessaging();
    }

    /**
     * Kirim notifikasi ke satu device (HTTP v1)
     */
    public function sendToDevice(string $fcmToken, string $title, string $body, array $data = []): bool
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('token', $fcmToken)
            ->withNotification($notification)
            ->withData($data);

        try {
            $this->messaging->send($message);
            Log::info('✅ FCM Notification sent successfully', [
                'token' => substr($fcmToken, 0, 20) . '...',
                'title' => $title
            ]);
            return true;
        } catch (\Throwable $e) {
            Log::error('❌ FCM Notification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim ke banyak device
     */
    public function sendToMultipleDevices(array $fcmTokens, string $title, string $body, array $data = []): bool
    {
        $notification = Notification::create($title, $body);

        $messages = array_map(fn($token) =>
            CloudMessage::withTarget('token', $token)
                ->withNotification($notification)
                ->withData($data), $fcmTokens);

        try {
            $this->messaging->sendAll($messages);
            Log::info('✅ FCM Multi Notification sent', ['count' => count($fcmTokens)]);
            return true;
        } catch (\Throwable $e) {
            Log::error('❌ FCM Multi Notification failed: ' . $e->getMessage());
            return false;
        }
    }
}
