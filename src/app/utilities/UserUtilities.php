<?php
namespace Forum\Utilities;

class UserUtilities 
{
    public function checkUserName(string $name): bool 
    {
        return Validator::match($name, '/^[a-z0-9_-]{5,30}$/');
    }

    public function checkPassword(string $password): bool
    {
        return Validator::match($password, '/^\S{5,60}$/');
    }

}