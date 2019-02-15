<?php
namespace Forum\Libs;

use Forum\Utilities\Access;

class View 
{
    public function __construct() 
    {
        $this->accessAdmin = Access::admin();
        $this->accessUser = Access::user();
    }

    public function render(string $file, bool $requireHeader = true, bool $requireFooter = true) 
    {
        if ($requireHeader && $requireFooter) {
            require_once DIR_VIEWS . '/header.php';
            require_once DIR_VIEWS . $file;
            require_once DIR_VIEWS . '/footer.php';
        } else if ($requireHeader) {
            require_once DIR_VIEWS . '/header.php';
            require_once DIR_VIEWS . $file;
        } else {
            require_once DIR_VIEWS . $file;
            require_once DIR_VIEWS . '/footer.php';
        }
    }
}