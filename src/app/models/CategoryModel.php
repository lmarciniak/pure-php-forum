<?php
namespace Forum\Models;

class CategoryModel extends \Forum\Libs\Model 
{
    public function __construct() 
    {
        parent::__construct();
    }

    /**
     * @param string $category Name of the category
     * @return int
     */
    public function getCategorySize(string $category): int
    {
        $data = ['category' => $category];
        $query = "SELECT COUNT(*) AS 'length' FROM topic JOIN category ON category.id=topic.category_id WHERE category.name=:category";
        return $this->db->select($query, $data)[0]['length'];
    }

    public function getCategoryList(): array
    {
        $query = "SELECT * FROM category";
        return $this->db->select($query);
    }

    /**
     * @param string $category Name of the category
     * @param int $currentPage Current page number
     * @param int $limit How many topic to load
     * @return array
     */
    public function getTopicList(string $category, int $currentPage, int $limit): array
    {
        $data = ['category' => $category, 'limit' => $limit, 'offset' => ($currentPage - 1) * $limit];
        $query = "SELECT topic.id, topic.name AS topic_name, topic.last_reply, user.name AS user_name FROM topic JOIN category ON category.id=topic.category_id JOIN user ON topic.user_id=user.id WHERE category.name=:category ORDER BY last_reply DESC LIMIT :limit OFFSET :offset";
        return $this->db->select($query, $data);
    }
}