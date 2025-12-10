<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GoApiService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.goapi.key');
        $this->baseUrl = config('services.goapi.base_url');
    }

    protected function makeRequest($method, $endpoint, $data = [])
    {
        try {
            $response = Http::withHeaders([
                'X-API-Key' => $this->apiKey,
                'Accept' => 'application/json',
            ])->$method($this->baseUrl . $endpoint, $data);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()
                ];
            }

            return [
                'success' => false,
                'error' => $response->body(),
                'status' => $response->status()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    // 4 endpoint methods
    public function getWeather($city)
    {
        return $this->makeRequest('get', '/weather', ['city' => $city]);
    }

    public function getCurrency($from, $to)
    {
        return $this->makeRequest('get', '/currency', ['from' => $from, 'to' => $to]);
    }

    public function getNews($category = 'technology')
    {
        return $this->makeRequest('get', '/news', ['category' => $category]);
    }

    public function postData($payload)
    {
        return $this->makeRequest('post', '/data', $payload);
    }
}

