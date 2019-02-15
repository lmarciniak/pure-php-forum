<?php
namespace Forum\Models;

class ForumModel extends \Forum\Libs\Model 
{
    public function __construct() 
    {
        parent::__construct();
    }

    /**
     * @param string $ID Id the topic
     * @param string $category Name of the category
     * @return bool
     */
    public function topicExists($ID, $category) 
    {
        $query = "SELECT * FROM topic JOIN category ON topic.category_id=category.id WHERE topic.id=:id AND category.name=:category";
        return !empty($this->db->select($query, ['id' => $ID, 'category' => $category]));
    }

    /**
     * @param string $category Name of the category
     * @return bool
     */
    public function categoryExists($category) 
    {
        $query = "SELECT * FROM category WHERE name=:name";
        return !empty($this->db->select($query, ['name' => $category]));
    } 
}