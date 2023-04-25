<?php
namespace System\Response;

/**
 * @author dhenfie <fajarsusilo1600@gmail.com>
 * @license MIT
 * @version 1.0.0
 */

class Response
{

    protected array $listHeader = array(
        200 => 'HTTP/1.1 200 OK',
        400 => 'HTTP/1.1 400 Bad Request',
        401 => 'HTTP/1.1 401 Unauthorized',
        404 => 'HTTP/1.1 404 Not Found',
        500 => 'HTTP/1.1 500 Internal Server Error',
        503 => 'HTTP/1.1 503 Service Unavailable'
    );

    private int $httpCode;

    private string $message;

    private string $contentType;

    public function __construct(int $httpCode = 200, string $message = "", string $contentType = 'text/html'
    ) {
        $this->initialize($httpCode, $message, $contentType);
    }

    public function initialize(int $httpCode, string $message, string $contentType): void
    {
        $this->setHttpCode($httpCode);
        $this->setContentType($contentType);
        $this->setMessage($message);
    }

    public function getHttpCode() : int
    {
        return $this->httpCode;
    }

    public function setHttpCode(int $httpCode) : self
    {
        $this->httpCode = $httpCode;
        return $this;
    }

    public function getMessage() : string
    {
        return $this->message;
    }

    public function setMessage(string $message) : self
    {
        $this->message = $message;
        return $this;
    }

    public function getContentType() : string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType) : self
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function send() : string
    {
        $header      = $this->listHeader[$this->getHttpCode()];
        $message     = $this->message;
        $contentType = 'Content-Type: ' . $this->getContentType();

        header($header);
        header($contentType);

        return $message;
    }

    public function __toString() : string
    {
        return $this->send();
    }
}
