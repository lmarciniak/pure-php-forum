<?php
namespace Forum\Utilities;

abstract class Filter
{
    public static function string(string $string): string 
    {
        return filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }

    public static function int(int $integer): int 
    {
        return (int)$integer = filter_var($integer, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function email(string $email): string 
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }
}