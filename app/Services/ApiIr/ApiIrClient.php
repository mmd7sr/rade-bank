<?php

declare(strict_types=1);

namespace App\Services\ApiIr;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Response;

/**
 * Dedicated HTTP client for the api.ir service.
 *
 * Credentials are resolved from config/services.php (never hardcoded).
 */
class ApiIrClient
{
    private string $baseUrl;

    private ?string $token;

    public function __construct(private readonly HttpFactory $http)
    {
        /** @var array{base_url?: string, token?: ?string} $config */
        $config = (array) config('services.api_ir');

        $this->baseUrl = rtrim((string) ($config['base_url'] ?? ''), '/');
        $this->token = $config['token'] ?? null;
    }

    /**
     * Send a POST request to an api.ir endpoint and return the decoded body.
     *
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function post(string $endpoint, array $payload): array
    {
        $response = $this->request()->post($endpoint, $payload);

        $response->throw();

        return (array) $response->json();
    }

    private function request(): \Illuminate\Http\Client\PendingRequest
    {
        return $this->http
            ->baseUrl($this->baseUrl)
            ->acceptJson()
            ->asJson()
            ->withToken((string) $this->token);
    }
}
