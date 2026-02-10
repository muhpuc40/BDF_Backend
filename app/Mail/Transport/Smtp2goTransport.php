<?php

namespace App\Mail\Transport;

use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\MessageConverter;
use Illuminate\Support\Facades\Log;

class Smtp2goTransport extends AbstractTransport
{
    protected $apiKey;
    protected $apiUrl = 'https://api.smtp2go.com/v3/email/send';

    public function __construct($apiKey)
    {
        parent::__construct();
        $this->apiKey = $apiKey;
    }

    protected function doSend(SentMessage $message): void
    {
        try {
            $email = MessageConverter::toEmail($message->getOriginalMessage());
            
            // Prepare from address
            $from = $email->getFrom()[0];
            $sender = $from->getAddress();
            $fromName = $from->getName();
            if ($fromName) {
                $sender = "{$fromName} <{$sender}>";
            }

            // Prepare recipients
            $to = [];
            foreach ($email->getTo() as $address) {
                $toAddress = $address->getAddress();
                $toName = $address->getName();
                if ($toName) {
                    $toAddress = "{$toName} <{$toAddress}>";
                }
                $to[] = $toAddress;
            }

            // Build payload
            $payload = [
                'api_key' => $this->apiKey,
                'to' => $to,
                'sender' => $sender,
                'subject' => $email->getSubject(),
            ];

            // Add HTML body
            if ($htmlBody = $email->getHtmlBody()) {
                $payload['html_body'] = $htmlBody;
            }

            // Add text body
            if ($textBody = $email->getTextBody()) {
                $payload['text_body'] = $textBody;
            }

            // Send to SMTP2GO API
            $ch = curl_init($this->apiUrl);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
                CURLOPT_TIMEOUT => 30,
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            if (curl_errno($ch)) {
                throw new \Exception('CURL Error: ' . curl_error($ch));
            }
            
            curl_close($ch);

            // Check response
            if ($httpCode !== 200) {
                throw new \Exception('SMTP2GO API error - HTTP ' . $httpCode . ': ' . $response);
            }

            $responseData = json_decode($response, true);
            
            if (!$responseData || !isset($responseData['data'])) {
                throw new \Exception('Invalid response from SMTP2GO: ' . $response);
            }
            
            if ($responseData['data']['succeeded'] !== 1) {
                $error = $responseData['data']['error'] ?? 'Unknown error';
                throw new \Exception('SMTP2GO failed: ' . $error);
            }

            Log::info('Email sent via SMTP2GO', ['email_id' => $responseData['data']['email_id'] ?? 'unknown']);

        } catch (\Exception $e) {
            Log::error('SMTP2GO error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function __toString(): string
    {
        return 'smtp2go';
    }
}