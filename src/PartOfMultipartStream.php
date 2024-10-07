<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Psr\Http\Message\StreamInterface;

use const SEEK_SET;

final class PartOfMultipartStream implements PartOfMultipartStreamInterface
{
    /**
     * @param non-empty-string $name
     * @param array<non-empty-string,non-empty-string> $headers
     */
    public function __construct(
        private readonly string $name,
        private readonly StreamInterface $stream,
        private readonly string $filename = '',
        private readonly array $headers = []
    ) {
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getStream(): StreamInterface
    {
        return $this->stream;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return (string) $this->stream;
    }

    public function close(): void
    {
        $this->stream->close();
    }

    public function detach()
    {
        return $this->stream->detach();
    }

    public function getSize(): ?int
    {
        return $this->stream->getSize();
    }

    public function tell(): int
    {
        return $this->stream->tell();
    }

    public function eof(): bool
    {
        return $this->stream->eof();
    }

    public function isSeekable(): bool
    {
        return $this->stream->isSeekable();
    }

    public function seek(int $offset, int $whence = SEEK_SET): void
    {
        $this->stream->seek($offset, $whence);
    }

    public function rewind(): void
    {
        $this->stream->rewind();
    }

    public function isWritable(): bool
    {
        return $this->stream->isWritable();
    }

    public function write(string $string): int
    {
        return $this->stream->write($string);
    }

    public function isReadable(): bool
    {
        return $this->stream->isReadable();
    }

    public function read(int $length): string
    {
        return $this->stream->read($length);
    }

    public function getContents(): string
    {
        return $this->stream->getContents();
    }

    public function getMetadata(?string $key = null)
    {
        return $this->stream->getMetadata($key);
    }
}
