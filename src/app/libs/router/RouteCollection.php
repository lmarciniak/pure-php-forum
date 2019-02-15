<?php
namespace Forum\Libs\Routing;

class RouteCollection 
{
    private $items;

    public function add($name, $item) 
    {
        $this->items[$name] = $item;
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->items)) {
            return $this->items[$name];
        } else {
            return null;
        }
    }

    public function getAll() 
    {
        return $this->items;
    }
}