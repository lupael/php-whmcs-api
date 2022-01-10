<?php

declare(strict_types=1);

namespace i4e\WhmcsApi;

use i4e\WhmcsApi\HttpClient\Builder;
use i4e\WhmcsApi\HttpClient\Plugin\Authentication;
use i4e\WhmcsApi\HttpClient\Plugin\ContentType;
use i4e\WhmcsApi\HttpClient\Plugin\ExceptionHandler;
use i4e\WhmcsApi\HttpClient\Plugin\WhmcsContentType;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

class Client
{
    use ApiClassTrait;

    public const AUTH_API_CREDENTIALS = 'API_TOKEN';
    public const AUTH_LOGIN_CREDENTIALS = 'USERNAME_TOKEN';

    public const API_PATH = '/includes/api.php';
    public const USER_AGENT = 'php-whmcs-api';

    private Builder $httpClientBuilder;

    public function __construct()
    {
        $this->httpClientBuilder = $builder = new Builder();

        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => self::USER_AGENT,
        ]));
        $builder->addPlugin(new ExceptionHandler());
        $builder->addPlugin(new ContentType());
        $builder->addPlugin(new WhmcsContentType());
    }

    public function authenticate(string $identifier, string $secret, string $authMethod = self::AUTH_API_CREDENTIALS): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(
            new Authentication($authMethod, $identifier, $secret)
        );
    }

    public function url(string $url): void
    {
        $uri = $this->getHttpClientBuilder()->getUriFactory()->createUri($url);
        $uri = $uri->withPath(self::API_PATH);

        $this->getHttpClientBuilder()->removePlugin(BaseUriPlugin::class);
        $this->getHttpClientBuilder()->addPlugin(
            new BaseUriPlugin($uri, ['replace' => true])
        );
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
