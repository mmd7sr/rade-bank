<?php

declare(strict_types=1);

namespace App\Services\ApiIr;

use Illuminate\Http\Client\RequestException;
use RuntimeException;

/**
 * Business logic for bank card info lookups via the api.ir service.
 */
class BankCardService
{
    private const ENDPOINT = '/sw1/BankCardInfo';

    public function __construct(private readonly ApiIrClient $client)
    {
    }

    /**
     * Fetch information for the given card number.
     *
     * @return array<string, mixed>
     *
     * @throws \RuntimeException on any upstream or business failure (message carries no sensitive data)
     */
    public function getCardInfo(string $cardNumber): array
    {
        try {
            $response = $this->client->post(self::ENDPOINT, [
                'cardNumber' => $cardNumber,
            ]);
        } catch (RequestException $e) {
            throw new RuntimeException('دریافت اطلاعات کارت با خطا مواجه شد.', 0, $e);
        }

        // api.ir returns HTTP 200 even on failure; an empty `data` body means the
        // card could not be resolved. Treat that as a failed inquiry.
        if (blank(data_get($response, 'data'))) {
            throw new RuntimeException('اطلاعاتی برای این شماره کارت یافت نشد.');
        }

        return $response;
    }
}
