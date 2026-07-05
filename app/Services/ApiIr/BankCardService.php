<?php

declare(strict_types=1);

namespace App\Services\ApiIr;

/**
 * Business logic for bank card lookups via the api.ir service.
 */
class BankCardService
{
    public function __construct(private readonly ApiIrClient $client)
    {
    }

    /**
     * Fetch information for the given card number.
     *
     * @return array<string, mixed>
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getCardInfo(string $cardNumber): array
    {
        return $this->client->post('/sw1/BankCardInfo', [
            'cardNumber' => $cardNumber,
        ]);
    }
}
