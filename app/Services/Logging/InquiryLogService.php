<?php

declare(strict_types=1);

namespace App\Services\Logging;

use App\Models\InquiryLog;
use App\Models\User;

/**
 * Persists inquiry audit logs, ensuring sensitive input is masked
 * before it ever reaches storage.
 */
class InquiryLogService
{
    /**
     * Record a card-info inquiry attempt (successful or failed).
     *
     * The card number is masked before storage — the full PAN is never persisted.
     *
     * @param  array<string, mixed>|null  $responsePayload
     */
    public function logCardInquiry(
        ?User $user,
        string $cardNumber,
        string $status,
        ?int $httpStatus = null,
        ?array $responsePayload = null,
    ): InquiryLog {
        return InquiryLog::create([
            'user_id' => $user?->id,
            'service_name' => 'bank_card_info',
            'masked_input' => $this->maskCardNumber($cardNumber),
            'status' => $status,
            'http_status' => $httpStatus,
            'response_payload' => $responsePayload,
        ]);
    }

    /**
     * Mask a 16-digit card number as first 6 + last 4, e.g. 603799******0000.
     *
     * Non-conforming input is fully masked so a full PAN can never leak.
     */
    public function maskCardNumber(string $cardNumber): string
    {
        $digits = preg_replace('/\D/', '', $cardNumber) ?? '';

        if (strlen($digits) !== 16) {
            return str_repeat('*', max(strlen($digits), 4));
        }

        return substr($digits, 0, 6).str_repeat('*', 6).substr($digits, -4);
    }
}
