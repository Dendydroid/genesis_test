<?php

namespace App\Core;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class App extends BaseApp
{
    protected array $container = [];

    public function getController()
    {
        return (new ControllerResolver())->getController($this->request);
    }

    public function getArguments(): array
    {
        return (new ArgumentResolver())->getArguments($this->request, $this->controller);
    }

    public function run()
    {
        $matcher = new UrlMatcher($this->routes, $this->requestContext);

        $this->request->attributes->add($matcher->match($this->request->getPathInfo()));

        $this->controller = $this->getController();
        $this->arguments = $this->getArguments();

        $this->response = call_user_func_array($this->controller, $this->arguments);

        $this->response->send();
    }

    public function contain(string $key, $data)
    {
        $this->container[$key] = $data;
    }

    public function get(string $key)
    {
        return $this->container[$key];
    }
}