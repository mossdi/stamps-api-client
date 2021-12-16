<?php

namespace Panacea\Stamps\Contracts;

/**
 * Base interface for API clients.
 */
interface ClientInterface
{
    /**
     * @param string $url
     * @return self
     */
    public function setApiUrl(string $url): self;

    /**
     * @return string
     */
    public function getApiUrl(): string;

    /**
     * @param string $integrationId
     * @return self
     */
    public function setApiIntegrationId(string $integrationId): self;

    /**
     * @return string
     */
    public function getApiIntegrationId(): string;

    /**
     * @param string $userId
     * @return self
     */
    public function setApiUserId(string $userId): self;

    /**
     * @return string
     */
    public function getApiUserId(): string;

    /**
     * @param string $password
     * @return self
     */
    public function setApiPassword(string $password): self;

    /**
     * @return string
     */
    public function getApiPassword(): string;
}
