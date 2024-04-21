<?php
class Chat
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function seekerGetRecruiters($seeker_id)
    {
        $this->db->query('SELECT recruiters.id, recruiters.name, recruiters.business_name, chat_threads.created_at 
                    FROM chat_threads 
                    INNER JOIN recruiters ON chat_threads.recruiter_id = recruiters.id 
                    WHERE chat_threads.seeker_id = :seeker_id');
        $this->db->bind(':seeker_id', $seeker_id);

        return $this->db->resultSet();
    }
}
