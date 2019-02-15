<?php
namespace Forum\Libs;

class Model 
{
    protected function __construct() 
    {
        try {
            $this->db = new \Forum\utilities\Database();
        } catch (Exception $e) {
            echo "Cannot connect to the database, try later!";
            //echo $e->getMessage();
        }
    }
}