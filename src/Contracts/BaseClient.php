<?php

namespace Panacea\Stamps\Contracts;

use Exception;
use SoapClient;

abstract class BaseClient
{
    /**
     * @var SoapClient
     */
    protected $soapClient;

    /**
     * @var string
     */
    protected $apiIntegrationId;

    /**
     * @var string
     */
    protected $apiUserId;

    /**
     * @var string
     */
    protected $apiPassword;

    /**
     * @throws Exception
     */
    public function __construct(string $apiUrl)
    {
        $this->soapClient = new SoapClient(sprintf('%s?WSDL', $apiUrl), ['exceptions' => true]);
        $this->soapClient->__setLocation($apiUrl);
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
