<?php

namespace Alpifra\DaxiumPHP;

use Alpifra\DaxiumPHP\Http\Request;

/**
 * Base client for various Daxium Air API services
 * 
 * @see https://doc-dev.daxium-air.com/
 */
class BaseClient
{

    public const BASE_URL = 'https://api.daxium-air.com';
    public const AUTH_PATH = '/oauth/v2/token';
    public const API_VERSION = 'v1.3';

    public function __construct(
        protected string $clientId,
        protected string $clientSecret,
        protected string $username,
        protected string $password,
        protected string $appShort
    ) {}

    public function initRequest(): Request
    {
        $request = new Request(
            $this->clientId,
            $this->clientSecret,
            $this->username,
            $this->password
        );

        $request->apiVersion = self::API_VERSION;
        $response = $request->postFormUrlEncoded(self::AUTH_PATH, [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username'      => $this->username,
            'password'      => $this->password,
            'grant_type'    => 'password'
        ]);

        $request->token = $response->access_token;

        return $request;
    }

}
