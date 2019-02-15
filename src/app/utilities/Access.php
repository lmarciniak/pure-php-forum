<?php
namespace Forum\Utilities;

abstract class Access 
{
    public static function unlogged() 
    {
        if (Session::get('logged')) {
            header("location: " . HTTP_SERVER);
            exit;
        }
    }

    public static function logged() 
    {
        if (!Session::get('logged')) {
            header("location: " . HTTP_SERVER);
            exit;
        }
    }

    public static function privileges() 
    {
        if (Session::get('userInfo')['role'] != 'admin') {
            header("location: " . HTTP_SERVER);
            exit;
        }
    }

    public static function user() 
    {
        return Session::get('logged');
    }

    public static function admin() 
    {
        return Session::get('userInfo')['role'] == 'admin';
    }
}