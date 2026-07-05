<?php

declare(strict_types=1);

namespace App\Services\ApiIr;

use Illuminate\Http\Client\RequestException;
use RuntimeException;

/**
 * Resolves a bank account (deposit) number to its sheba (IBAN) via api.ir.
 *
 * NOTE: Confirm the endpoint and payload keys below against the api.ir docs for
 * your subscription — they are centralised here so a change is a one-line edit.
 */
class AccountToShebaService
{
    private const ENDPOINT = '/sw1/DepositToIBAN';

    public function __construct(private readonly ApiIrClient $client)
    {
    }

    /**
     * Convert an account number (for the given bank code) to its sheba number.
     *
     * @return array<string, mixed>
     *
     * @throws \RuntimeException on any upstream failure (message carries no sensitive data)
     */
    public function convert(string $accountNumber, string $bankCode): array
    {
        try {
            return $this->client->post(self::ENDPOINT, [
                'bankCode' => $bankCode,
                'accountNumber' => $accountNumber,
            ]);
        } catch (RequestException $e) {
            throw new RuntimeException('تبدیل شماره حساب به شبا با خطا مواجه شد.', 0, $e);
        }
    }
}
