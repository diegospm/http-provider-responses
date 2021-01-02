<?php

declare(strict_types=1);

namespace HttpProvider\Responses;

use HttpProvider\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    private int $code = 0;

    private string $content = '';

    public function setStatusCode(int $code): ResponseInterface
    {
        $this->code = $code;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function setContent(string $content): ResponseInterface
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function toArray(): ?array
    {
        return json_decode($this->content, true);
    }

    public function toObject(): ?object
    {
        return json_decode($this->content);
    }
}
