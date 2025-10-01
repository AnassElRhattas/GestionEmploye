<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class WhatsAppAutomationService
{
    private string $baseUrl;
    private int $timeout;

    public function __construct()
    {
        $this->baseUrl = config('services.whatsapp.base_url', 'http://localhost:3000');
        $this->timeout = (int) config('services.whatsapp.timeout', 30);
    }

    public function getStatus(): array
    {
        try {
            $response = Http::timeout($this->timeout)->get($this->baseUrl . '/status');
            if ($response->successful()) {
                return $response->json();
            }
            throw new Exception('Erreur lors de la vérification du statut: ' . $response->status());
        } catch (Exception $e) {
            Log::error('WhatsApp Service Status Error: ' . $e->getMessage());
            return [
                'connected' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function isServiceAvailable(): bool
    {
        try {
            Http::timeout(5)->get($this->baseUrl . '/status');
            return true;
        } catch (Exception $e) {
            Log::error('Erreur lors de la vérification du service WhatsApp: ' . $e->getMessage());
            return false;
        }
    }

    public function isWhatsAppConnected(): bool
    {
        $status = $this->getStatus();
        return isset($status['connected']) && $status['connected'] === true;
    }

    public function getQRCode(): ?string
    {
        try {
            $response = Http::timeout($this->timeout)->get($this->baseUrl . '/qrcode');
            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['success']) && !empty($data['qrCode'])) {
                    return $data['qrCode'];
                }
            }
            return null;
        } catch (Exception $e) {
            Log::error('WhatsApp QR Code Error: ' . $e->getMessage());
            return null;
        }
    }

    public function sendMessage(string $number, string $message): array
    {
        try {
            $cleanNumber = $this->formatPhoneNumber($number);
            $response = Http::timeout($this->timeout)->post($this->baseUrl . '/send-message', [
                'number' => $cleanNumber,
                'message' => $message,
            ]);
            if ($response->successful()) {
                $result = $response->json();
                Log::info("Message WhatsApp envoyé à {$cleanNumber}");
                return $result;
            }
            throw new Exception('Erreur lors de l\'envoi: ' . $response->body());
        } catch (Exception $e) {
            Log::error("Erreur envoi WhatsApp à {$number}: " . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function sendBulkMessages(array $contacts): array
    {
        try {
            $formatted = array_map(function ($contact) {
                return [
                    'number' => $this->formatPhoneNumber($contact['number'] ?? ''),
                    'message' => (string) ($contact['message'] ?? ''),
                ];
            }, $contacts);

            $response = Http::timeout($this->timeout * 2)->post($this->baseUrl . '/send-bulk', [
                'contacts' => $formatted,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                Log::info('Messages WhatsApp en masse envoyés: ' . count($formatted) . ' contacts');
                return $result;
            }
            throw new Exception('Erreur lors de l\'envoi en masse: ' . $response->body());
        } catch (Exception $e) {
            Log::error('Erreur envoi en masse WhatsApp: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    private function formatPhoneNumber(string $number): string
    {
        $clean = preg_replace('/[^0-9]/', '', $number ?? '');
        if ($clean === '') {
            return $clean;
        }
        if (str_starts_with($clean, '0')) {
            $clean = '212' . substr($clean, 1);
        }
        if (!str_starts_with($clean, '212')) {
            $clean = '212' . $clean;
        }
        return $clean;
    }
}


