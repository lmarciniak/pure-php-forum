<?php
namespace Forum\Models;

use Forum\Utilities\Session;

class TopicModel extends \Forum\Libs\Model 
{
    public function __construct() 
    {
        parent::__construct();
    }

    /**
     * @param string $topicName Name of the topic
     * @param string $body Body of the topic
     * @param string $category Name of the topic category 
     * @return int|bool
     */
    public function addTopic(string $topicName, string $body, string $category): int
    {
        $query = "SELECT id FROM category WHERE name=:name";
        $category_id = $this->db->select($query, ['name' => $category])[0]['id'];
        $data = ['name' => $topicName, 'body' => $body, 'category' => $category_id, 'userID' => Session::get('userInfo')['id'], 'created' => date("Y-m-d H:i:s"), 'lastReply' => date("Y-m-d H:i:s")];
        if ($this->db->insert('topic', $data))
            return $this->db->lastInsertId();
        else
            return 0;
    }

    /**
     * @param int $id ID of the topic
     * @return int
     */
    public function getTopicSize(int $id): int 
    {
        $query = "SELECT COUNT(*) AS 'length' FROM post WHERE topic_id=:id";
        return $this->db->select($query, ['id' => $id])[0]['length'];
    }

    /**
     * @param int $id ID of the topic
     * @param string $category Name of the category
     * @return array
     */
    public function getTopicInfo(int $id, string $category): array 
    {
        $query = "SELECT topic.*, user.name AS owner FROM `topic` JOIN user ON topic.user_id=user.id JOIN category ON topic.category_id=category.id WHERE topic.id=:id AND category.name=:category";
        return @$this->db->select($query, ['id' => $id, 'category' => $category])[0];
    }

    /**
     * @param int $id ID of the topic
     * @param string $category Category of the topic
     * @param int $page Page number
     * @param int $limit How many posts to load
     * @return array
     */
    public function getPostList(int $id, string $category, int $page, int $limit): array
    {
        $query = "SELECT user.name AS owner, post.id, post.body, post.created_at FROM post JOIN user ON post.user_id=user.id JOIN topic ON topic.id=post.topic_id JOIN category ON category.id=topic.category_id WHERE post.topic_id=:id AND category.name=:category LIMIT :limit OFFSET :offset";
        $data = ['id' => $id, 'category' => $category, 'limit' => $limit, 'offset' => ($page - 1) * $limit];
        return $this->db->select($query, $data);
    }

    /**
     * @param int @id Id of the topic
     * @return bool
     */
    public function delete(int $id): bool 
    {
        try {
            $this->db->beginTransaction();
            $this->db->delete('post', "topic_id=" . $id);
            $this->db->delete('topic', 'id=' . $id);
            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            //echo $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }

}