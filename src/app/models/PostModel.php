<?php
namespace Forum\Models;

use Forum\Utilities\Session;

class PostModel extends \Forum\Models\TopicModel 
{
    public function __construct() 
    {
        parent::__construct();
    }

    /**
     * @param int $topicID Id of the topic
     * @param string $body Body of the post
     * @return bool
     */
    public function add(int $topicID, string $body): bool 
    {
        try {
            $this->db->beginTransaction();
            $this->db->update("topic", "last_reply", date("Y-m-d H:i:s"), "id=" . $topicID);
            $data = [
                'topic_id' => $topicID, 'user_id' => Session::get('userInfo')['id'], 'body' => $body,
                'created_at' => date("Y-m-d H:i:s")
            ];
            $this->db->insert('post', $data);
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * @param int $int Id of the post
     * @return bool
     */
    public function delete(int $id): bool 
    {
        return $this->db->delete('post', "id=" . $id) ? true : false;
    }
}