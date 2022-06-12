<?php
namespace App\SMS;

use Nexmo\Client\Credentials\Basic;
use Nexmo\Client;
use Nexmo\Client\Exception\Request as NexmoExceptionRequest;
use Log;

class NexmoService
{
    public static function sendSMS($phoneNumber, $content, $from = null)
    {
        $basic = new Basic(env('NEXMO_API_KEY'), env('NEXMO_API_SECRET'));
        $client = new Client($basic);

        try 
        {
            $client->message()->send([
                'to' => $phoneNumber,
                'from' => $from ?? env('NEXMO_FROM_SEND'),
                'text' => $content,
            ]);

            return true;
        } catch (NexmoExceptionRequest $e) {
            Log::error($e); //Nexmo error
        }

        throw new \Exception('Nexmo send sms code error', 200);
    }
}


