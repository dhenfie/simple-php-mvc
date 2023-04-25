<?php
namespace System\View;

use Config\Config;
use Dhenfie\TemplateSystem\TemplateSystem;
use Exception;
use System\Response\Response;

/**
 * @method static mixed render(string $filename, array $data = [], bool $useReturn)
 */
class View
{

    private TemplateSystem $engine;

    private Response $response;

    public function __construct(TemplateSystem $engine, Response $response)
    {
        $this->engine   = $engine;
        $this->response = $response;
    }

    public static function render(string $filename, array $data = [], int $httpCode = 200)
    {
        $instance = new static(new TemplateSystem(), new Response());
        $engine   = $instance->engine;
        $response = $instance->response;

        $config = Config::$config['viewPath'];
        $engine->setViewPath($config);
        $viewString = $engine->render($filename, $data, true);

        $response->setHttpCode($httpCode);
        $response->setContentType('text/html');
        $response->setMessage($viewString);

        return $response->send();
    }
}
