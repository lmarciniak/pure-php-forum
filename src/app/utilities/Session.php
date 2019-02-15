<?php
namespace Forum\Utilities;

abstract class Session 
{
    public static function set($key, $value) 
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key) 
    {
        if (array_key_exists($key, $_SESSION))
            return $_SESSION[$key];
    }

    public static function destroy() 
    {
        session_destroy();
    }
}