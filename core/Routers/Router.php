<?php

namespace Synext\Routers;

use Exception;
use AltoRouter;
use Synext\Requests\Http;
class Router{
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

    public function __construct(string $view_path, string $public_path)
    {
        $this->view_path = $view_path.DIRECTORY_SEPARATOR;
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
    public function get(string $url, string $view,?string $name = null): self
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
    public function post(string $url, string $view,?string $name = null): self
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
    public function getPost(string $url, string $view,?string $name = null): self
    {
        
        $this->router->map('GET|POST', $url, $view, $name);

        return $this;
    }
    /**
     * To add Api Route For json data return or orther
     * With this route you can not display html content in web browser
     * @param array $routes
     *         $routes = [
     *      [$method, $route, $target, $name]
     *   ];
     *
     */
    public function resource(array $routes){
        //dd($routes);
        
        $this->router->addRoutes($routes);
        return $this;
    }
    public function run(): self
    {   /**
        * @var  array or bool 
        */
        $match = $this->router->match();
        if(is_bool($match) && $match === false){
            /** Route not found */
            require_once $this->view_path.'errors/400.php';
            Http::status(400);
            die();
        }

        [$route_view,$route_param,$route_name] = array_values($match);
        $router = $this;
        $view_content_files = $this->view_path.$route_view.'.php';

        if(!file_exists($view_content_files)){
            /** view file not found */
            require_once $this->view_path.'errors/404.php';
            Http::status(404);
            die();
        }

        /** i can get more then 1 line */
        $layout_line = trim(str_replace(['?','<','>',';'],'',rtrim(file($view_content_files)[0])));
        /** i can do more */
        $layout = $layout_line[0] === '@' ? $this->view_path.explode('::',$layout_line)[1].'.php' : false;
       // $layout = $this->view_path.explode('::',$layout_line)[1].'.php';
        // $f = new RecursiveDirectoryIterator($this->view_path);
        // // dd($f);
        // foreach(new RecursiveIteratorIterator($f) as $file)
        // {
        //     dump($file);
        // }

        if(!is_bool($layout) && !file_exists($layout)){
            /** view file not found */
            require_once $this->view_path.'errors/404.php';
            Http::status(404);
            die();
        }

        if($layout_line[0] === '@'){
            ob_start();
            require_once $view_content_files;
            $contents = ob_get_clean();
            /** default layout path */
            require_once $layout;
            // require_once dirname(__DIR__,2).$this->default_layout_path;
        }else{
            require_once $view_content_files;
        }
        return $this;
    }
}
