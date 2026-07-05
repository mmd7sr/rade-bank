<?php

declare(strict_types=1);

namespace App\Services\ApiIr;

use Illuminate\Http\Client\RequestException;
use RuntimeException;

/**
 * Resolves a bank card number to its sheba (IBAN) via the api.ir CardToIban service.
 */
class CardToShebaService
{
    private const ENDPOINT = '/sw1/CardToIban';

    public function __construct(private readonly ApiIrClient $client)
    {
    }

    /**
     * Convert a card number to its sheba (IBAN) number.
     *
     * @return array<string, mixed>
     *
     * @throws \RuntimeException on any upstream failure (message carries no sensitive data)
     */
    public function convert(string $cardNumber): array
    {
        try {
            $response = $this->client->post(self::ENDPOINT, [
                'cardNumber' => $cardNumber,
            ]);
        } catch (RequestException $e) {
            throw new RuntimeException('تبدیل شماره کارت به شبا با خطا مواجه شد.', 0, $e);
        }

        // api.ir returns HTTP 200 even on failure; a missing IBAN in the body
        // means the card could not be resolved. Treat that as a failed inquiry.
        if (blank(data_get($response, 'data.iban'))) {
            throw new RuntimeException('اطلاعاتی برای این شماره کارت یافت نشد.');
        }

        return $response;
    }
}
