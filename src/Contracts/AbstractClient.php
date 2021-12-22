<?php

namespace Panacea\Stamps\Contracts;

use Exception;
use SoapClient;

/**
 * Base API client.
 */
abstract class AbstractClient
{
    protected string $apiIntegrationId;

    protected string $apiUserId;

    protected string $apiPassword;

    protected SoapClient $soapClient;

    /**
     * @throws Exception
     */
    public function __construct(string $wsdl)
    {
        $this->soapClient = new SoapClient($wsdl, ['exceptions' => true]);
        $this->soapClient->__setLocation($wsdl);
    }

    /**
     * @return string
     */
    final public function getAuthToken(): string
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

    /**
     * @param string $integrationId
     * @return $this
     */
    protected function setApiIntegrationId(string $integrationId): self
    {
        $this->apiIntegrationId = $integrationId;
        return $this;
    }

    /**
     * @param string $userId
     * @return $this
     */
    protected function setApiUserId(string $userId): self
    {
        $this->apiUserId = $userId;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    protected function setApiPassword(string $password): self
    {
        $this->apiPassword = $password;
        return $this;
    }
}
