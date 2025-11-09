<?php

namespace App\Services;

use RuntimeException;

class OmdbApiService
{
    private \CurlHandle $curlHandle;

    public function __construct()
    {
    }

    public function get(array $parameters): array
    {
        $this->curlHandle = curl_init();
        $parameters['apikey'] = env('OMDB_APIKEY');
        curl_setopt(
            $this->curlHandle,
            CURLOPT_URL,
            'http://www.omdbapi.com/?' . http_build_query($parameters));
        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($this->curlHandle);
        if ($response === false) {
            throw new RuntimeException(curl_error($this->curlHandle));
        }

        $httpCode = curl_getinfo($this->curlHandle, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            throw new RuntimeException('Fehler beim Aufrufen der API: ' . $httpCode);
        }

        curl_close($this->curlHandle);

        return json_decode($response, true);
    }
}
