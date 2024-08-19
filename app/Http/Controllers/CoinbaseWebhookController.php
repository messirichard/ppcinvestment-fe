<?php

namespace App\Http\Controllers;

use App\Models\LeftToken;
use Illuminate\Http\Request;
use App\Models\CoinbaseTransaction;
use Illuminate\Support\Facades\Log;

class CoinbaseWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Ambil header signature dari request
        $signature = $request->header('X-CC-Webhook-Signature');
        $webhookSecret = env('COINBASE_WEBHOOK_SECRET');

        // Verifikasi signature
        if (!$this->verifySignature($request->getContent(), $signature, $webhookSecret)) {
            Log::error('Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Parse payload
        $payload = $request->json()->all();

        // Log payload untuk debugging
        Log::info('Coinbase webhook payload: ' . json_encode($payload));

        // Proses event berdasarkan jenis event
        $eventType = $payload['event']['type'];
        $eventData = $payload['event']['data'];
        $tokenLeftAmount = $eventData['id']['metadata']['token_amount'];

        switch ($eventType) {
            case 'charge:confirmed':
                $this->handleChargeConfirmed($eventData, $tokenLeftAmount);
                break;

            case 'charge:failed':
                $this->handleChargeFailed($eventData);
                break;

                // Tambahkan kasus lain jika diperlukan

            default:
                Log::warning('Unhandled event type: ' . $eventType);
                break;
        }

        return response()->json(['status' => 'success'], 200);
    }

    private function verifySignature($payload, $signature, $webhookSecret)
    {
        // Verifikasi signature webhook
        $computedSignature = hash_hmac('sha256', $payload, $webhookSecret);

        return hash_equals($computedSignature, $signature);
    }

    private function handleChargeConfirmed($eventData, $royalCoinAmount)
    {
        // Implementasikan logika untuk menangani charge yang dikonfirmasi
        CoinbaseTransaction::where('coinbase_charge_id', $eventData['id'])
            ->update([
                'status' => 'confirmed'
            ]);
        LeftToken::query()->decrement('left_token_amount', $royalCoinAmount);
    }

    private function handleChargeFailed($eventData)
    {
        // Implementasikan logika untuk menangani charge yang gagal
        CoinbaseTransaction::where('coinbase_charge_id', $eventData['id'])
            ->update([
                'status' => 'failed'
            ]);
    }
}
