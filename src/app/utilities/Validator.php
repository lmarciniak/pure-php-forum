<?php
namespace Forum\Utilities;

abstract class Validator 
{
    public static function match(string $subject, string $rule): bool 
    {
        return preg_match($rule, $subject);
    }

    public static function emptyArray($array = []): bool 
    {
        if (empty($array)) 
            return true;
        foreach ($array as $value) {
            if (empty($value)) 
                return true;
        }
        return false;
    }

    public static function length(string $subject, int $min, int $max): bool 
    {
        $subject = str_replace(" ", '', $subject);
        return strlen($subject) >= $min && strlen($subject) <= $max;
    }
}