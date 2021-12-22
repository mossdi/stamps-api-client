<?php

namespace Panacea\Stamps\Dto;

class Label
{
    private string $url;
    private string $extension;
    private ?string $content;

    /**
     * @param string $url
     * @param string $extension
     * @param string|null $content
     */
    public function __construct(
        string $url,
        string $extension,
        string $content = null
    ) {
        $this->url = $url;
        $this->extension = $extension;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
}
