<?php
namespace Forum\Libs\Routing;

class Route {

    private $path;

    private $file;

    private $class;

    private $method;

    private $defaults;

    private $params;

    public function __construct($path, $config, $params = [], $defaults = []) 
    {
        $this->path = $path;
        $this->file = $config['file'];
        $this->class = $config['class'];
        $this->method = $config['method'];
        $this->setParams($params);
        $this->setDefaults($defaults);
    }

    public function setPath($path) 
    {
        $this->path = HTTP_SERVER . $path;
    }

    public function getPath() 
    {
        return $this->path;
    }

    public function setFile($controller) 
    {
        $this->file = $controller;
    }

    public function getFile() 
    {
        return $this->file;
    }

    public function setClass($class) 
    {
        $this->class = $class;
    }

    public function getClass() 
    {
        return $this->class;
    }

    public function setMethod($method) 
    {
        $this->method = $method;
    }

    public function getMethod() 
    {
        return $this->method;
    }

    public function setDefaults($defaults) 
    {
        $this->defaults = $defaults;
    }

    public function getDefaults() 
    {
        return $this->defaults;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getParams() 
    {
        return $this->params;
    }
}
