<?php

namespace Panacea\Stamps\Contracts;

use Exception;
use SoapClient;

/**
 * Base API client.
 */
abstract class AbstractClient implements ClientInterface
{
    protected string $apiUrl = 'https://swsim.stamps.com/swsim/swsimv35.asmx?WSDL';

    protected string $apiIntegrationId;

    protected string $apiUserId;

    protected string $apiPassword;

    protected SoapClient $soapClient;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->soapClient = new SoapClient($this->apiUrl, [
            'exceptions' => true
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setApiUrl(string $url): static
    {
        $this->apiUrl = $url;
        $this->soapClient->__setLocation($this->apiUrl);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiIntegrationId(string $integrationId): static
    {
        $this->apiIntegrationId = $integrationId;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiIntegrationId(): string
    {
        return $this->apiIntegrationId;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiUserId(string $userId): static
    {
        $this->apiUserId = $userId;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiUserId(): string
    {
        return $this->apiUserId;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiPassword(string $password): static
    {
        $this->apiPassword = $password;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiPassword(): string
    {
        return $this->apiPassword;
    }

    /**
     * Gets the auth token for API requests.
     *
     * @return string
     */
    protected function getAuthToken(): string
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
