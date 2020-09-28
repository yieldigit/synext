<?php

namespace Synext\Routers;

use AltoRouter;
use Exception;

class Router
{
    /**
     * router.
     *
     * @var AltoRouter
     */
    private $router;
    /**
     * view_path.
     *
     * @var string
     */
    private $view_path;
    private $layout_path;
    private $default_layout_path;
    private $admin_layout_Path ;

    public function __construct(string $view_path, string $public_path)
    {
        $this->view_path = $view_path;
        $this->layout_path = $public_path.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR;
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
        if(is_bool($match)){
            throw new Exception("Route not found");
        }
        $view = $match['target'];
        $params = $match['params'];
        /** @var Router */
        $router = $this;
        $content_files = $this->view_path.DIRECTORY_SEPARATOR.$view.'.php';
        if(!file_exists($content_files)){
            throw new Exception("The route does not correspond to any view");
        }
        ob_start();
        require_once $content_files;
        $contents = ob_get_clean();
        /** default layout path */
        $this->default_layout_path = $this->layout_path.'defaults'.DIRECTORY_SEPARATOR.'index.php';
        require_once dirname(__DIR__,2).$this->default_layout_path;
        return $this;
    }
}