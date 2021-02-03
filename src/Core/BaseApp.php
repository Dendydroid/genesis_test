<?php

namespace App\Core;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Router;

abstract class BaseApp extends Singleton implements IApp
{

    public Request $request;
    public ?Response $response;
    protected Router $router;
    protected ?RouteCollection $routes;
    protected RequestContext $requestContext;

    protected $controller;
    protected array $arguments;

    protected function __construct(string $path = "")
    {
        parent::__construct($path);

        $this->setRequest()
        ->setRequestContext()
        ->setRouter();

        $this->routes = $this->router->getRouteCollection();
    }

    private function setRequest(): static
    {
        $this->request = Request::createFromGlobals();
        return $this;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    private function setRequestContext(): static
    {
        $this->requestContext = new RequestContext();
        $this->requestContext->fromRequest($this->request);
        return $this;
    }

    private function setRouter(): static
    {
        $fileLocator = new FileLocator([__DIR__]);

        $this->router = new Router(
            new YamlFileLoader($fileLocator),
            $this->path.'/config/routes.yml',
            ['cache_dir' => $this->path.'/storage/cache']
        );

        return $this;
    }
}