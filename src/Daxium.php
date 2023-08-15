<?php

namespace Alpifra\DaxiumPHP;

use Alpifra\DaxiumPHP\Http\Request;

/**
 * Base client for various Daxium Air API services
 * 
 * @see https://doc-dev.daxium-air.com/
 */
final class Daxium
{

    public const BASE_URL = 'https://api.daxium-air.com';
    public const AUTH_PATH = '/oauth/v2/token';
    public const API_VERSION = 'v1.3';

    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private string $username,
        private string $password
    ) {}

    protected function initRequest(): Request
    {
        $request =  new Request(
            $this->clientId,
            $this->clientSecret,
            $this->username,
            $this->password
        );

        return $request;
    }

}
