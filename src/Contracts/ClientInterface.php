<?php

namespace Panacea\Stamps\Contracts;

/**
 * Base interface for API clients.
 */
interface ClientInterface
{
    /**
     * @param string $url
     * @return $this
     */
    public function setApiUrl(string $url): static;

    /**
     * @return string
     */
    public function getApiUrl(): string;

    /**
     * @param string $integrationId
     * @return $this
     */
    public function setApiIntegrationId(string $integrationId): static;

    /**
     * @return string
     */
    public function getApiIntegrationId(): string;

    /**
     * @param string $userId
     * @return $this
     */
    public function setApiUserId(string $userId): static;

    /**
     * @return string
     */
    public function getApiUserId(): string;

    /**
     * @param string $password
     * @return $this
     */
    public function setApiPassword(string $password): static;

    /**
     * @return string
     */
    public function getApiPassword(): string;
}
