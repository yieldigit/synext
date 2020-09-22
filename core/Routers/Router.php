<?php

namespace Synext\Routers;

use AltoRouter;

class Router
{
    /**
     * router.
     *
     * @var AltoRouter
     */
    private $router;
    /**
     * viewPath.
     *
     * @var string
     */
    private $viewPath;

    private $layoutsPath = 'public_html/layouts/index.php';
    private $adminLayoutsPath = 'public_html/adminslayouts/index.php';

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    /**
     * genrate url by link name.
     *
     * @param string $name
     * @param array  $param
     *
     * @return string
     */
    public function url(string $name, array $param = []): string
    {
        return $this->router->generate($name, $param);
    }

    /**
     * get method for router.
     *
     * @param string $url
     * @param string $view
     * @param string $name
     *
     * @return self
     */
    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    /**
     * post routing.
     *
     * @param string $url
     * @param string $view
     * @param string $name
     *
     * @return self
     */
    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }
    /**
     * getpost routing.
     *
     * @param string $url
     * @param string $view
     * @param string $name
     *
     * @return self
     */
    public function getPost(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET|POST', $url, $view, $name);

        return $this;
    }
    public function run(): self
    {
        $match = $this->router->match();
        try{
            $view = $match['target'];
            $params = $match['params'];
        }catch(\Exception $e){
            http_response_code(404);
            require dirname(__DIR__).DIRECTORY_SEPARATOR.'views/errors/404.php';
            die();
        }
        if (in_array('admins', explode('/', $view))) {
            /** @var Router */
            //dd(in_array('admins',explode('/',$view)));
            $router = $this;
            ob_start();
            require_once $this->viewPath.DIRECTORY_SEPARATOR.$view.'.php';
            $contentsadmin = ob_get_clean();
            require_once dirname(__DIR__).DIRECTORY_SEPARATOR.$this->adminLayoutsPath;

            return $this;
            exit;
        }
        if (!in_array('ajaxs', explode('/', $view))) {
            /** @var Router */
            $router = $this;
            ob_start();
            require_once $this->viewPath.DIRECTORY_SEPARATOR.$view.'.php';
            $contents = ob_get_clean();
            require_once dirname(__DIR__).DIRECTORY_SEPARATOR.$this->layoutsPath;
        } else {
            require_once $this->viewPath.DIRECTORY_SEPARATOR.$view.'.php';
        }

        return $this;
    }
}
