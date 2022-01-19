<?php

namespace Panacea\Stamps\Contracts;

use Exception;
use SoapClient;

abstract class BaseSoapClient
{
    /**
     * @var SoapClient
     */
    private $soapClient;

    /**
     * @var string
     */
    private $apiIntegrationId;

    /**
     * @var string
     */
    private $apiUserId;

    /**
     * @var string
     */
    private $apiPassword;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->soapClient = new SoapClient(
            sprintf('%s?WSDL', env('STAMPS_API_URL')),
            [
                'exceptions' => true
            ]
        );

        $this->soapClient->__setLocation(env('STAMPS_API_URL'));

        $this->apiUserId = env('STAMPS_API_USER_ID');
        $this->apiPassword = env('STAMPS_API_PASSWORD');
        $this->apiIntegrationId = env('STAMPS_API_INTEGRATION_ID');
    }

    /**
     * @return SoapClient
     */
    final protected function getSoapClient(): SoapClient
    {
        return $this->soapClient;
    }

    /**
     * @return string
     */
    final protected function getAuthToken(): string
    {
        $response = $this->soapClient->AuthenticateUser([
            'Credentials' => [
                'IntegrationID' => $this->apiIntegrationId,
                'Username' => $this->apiUserId,
                'Password' => $this->apiPassword
            ]
        ]);

        return $response->Authenticator;
    }
}
