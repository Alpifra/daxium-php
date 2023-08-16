<?php 

namespace Alpifra\DaxiumPHP\Http;

use Alpifra\DaxiumPHP\BaseClient;
use Alpifra\DaxiumPHP\Exception\RequestException;
use Alpifra\DaxiumPHP\Exception\ResponseException;

final class Request 
{

    public const TIME_LIMIT = 5000;

    private \CurlHandle|false $ch = false;

    public ?string $token = null;
    public ?string $apiVersion = null;

    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private string $username,
        private string $password
    ) {}

    /**
     * @param  string $path
     * @param  array<string, string|int|array<array-key, string>> $params
     * @return \stdClass
     * 
     * @throws RequestException
     */
    public function get(string $path, array $params = []): \stdClass
    {
        $this->init($path, $params)->setOptions();

        return json_decode($this->exec());
    }

    /**
     * @param  string $path
     * @param  array<string, string|int|array<array-key, string>> $params
     * @return string
     * 
     * @throws RequestException
     */
    public function getFile(string $path, array $params = []): string
    {
        $this->init($path, $params)->setOptions('application/json', '*/*');

        return $this->exec();
    }

    /**
     * @param  string $path
     * @param  array<string, string|int|array<array-key, string>> $params
     * @return \stdClass
     * 
     * @throws RequestException
     */
    public function post(string $path, array $params = []): \stdClass
    {
        $this->init($path, $params)->setOptions();
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($params));

        return json_decode($this->exec());
    }

    /**
     * @param  string $path
     * @param  array<string, string|int|array<array-key, string>> $params
     * @return \stdClass
     * 
     * @throws RequestException
     */
    public function postFormUrlEncoded(string $path, array $params = []): \stdClass
    {
        $this->init($path)->setOptions('application/x-www-form-urlencoded');
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($params));

        return json_decode($this->exec());
    }

    /**
     * @param  string $path
     * @param  array<string, string|int|array<array-key, string>> $params
     * @return null
     * 
     * @throws RequestException
     */
    public function delete(string $path, array $params = [])
    {
        $this->init($path, $params)->setOptions();
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        return json_decode($this->exec());
    }

    /**
     * @param  string $path
     * @param  array<string, string|int|array<array-key, string>> $params
     * @return self
     * 
     * @throws RequestException
     */
    private function init(string $path, array $params = []): self
    {
        $url = BaseClient::BASE_URL;
        $url .= $path;
        $url .= !empty($params) ? '?' . http_build_query($params) : '';

        set_time_limit(self::TIME_LIMIT);

        $this->ch = curl_init($url);
        if ($this->ch === false) {
            throw new RequestException(sprintf('Request initialization to "%s" failed.', $url));
        }

        return $this;
    }

    /**
     * @param  string $accept
     * @param  string $contentType
     * @return self
     */
    private function setOptions(string $contentType = 'application/json', string $accept = 'application/json;charset=utf-8'): self
    {
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, [
            "Accept: {$accept}",
            "Content-type: {$contentType}",
            "Authorization: Bearer {$this->token}",
            'Cache-Control: no-cache',
            "X-Accept-Version: {$this->apiVersion}",
        ]);

        return $this;
    }

    /**
     * @return string
     * 
     * @throws ResponseException
     */
    private function exec(): string
    {
        $result = curl_exec($this->ch);
        if ($result === false) {
            $info = curl_getinfo($this->ch);
            curl_close($this->ch);
            throw new ResponseException("Failed to get response for {$info['url']}. Message: {$result}");
        }

        $code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if ($code >= 400) {
            curl_close($this->ch);
            throw new ResponseException("Server returned {$code} status code. Response: {$result}.");
        }

        curl_close($this->ch);

        return $result;
    }

}