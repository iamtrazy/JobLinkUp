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
        $this->db->query('SELECT chat_threads.id, recruiters.name, recruiters.profile_image, chat_threads.created_at 
                    FROM chat_threads 
                    INNER JOIN recruiters ON chat_threads.recruiter_id = recruiters.id 
                    WHERE chat_threads.seeker_id = :seeker_id');
        $this->db->bind(':seeker_id', $seeker_id);

        return $this->db->resultSet();
    }

    public function recruiterGetSeekers($recruiter_id)
    {
        $this->db->query('SELECT chat_threads.id, jobseekers.username, jobseekers.profile_image, chat_threads.created_at 
                    FROM chat_threads 
                    INNER JOIN jobseekers ON chat_threads.seeker_id = jobseekers.id 
                    WHERE chat_threads.recruiter_id = :recruiter_id');
        $this->db->bind(':recruiter_id', $recruiter_id);

        return $this->db->resultSet();
    }

    public function getChatMessages($thread_id)
    {
        $this->db->query('SELECT * FROM chat_texts WHERE thread_id = :thread_id ORDER BY created_at');
        $this->db->bind(':thread_id', $thread_id);

        $messages = $this->db->resultSet();

        // Format messages and add reply boolean
        $formatted_messages = [];
        foreach ($messages as $message) {
            $formatted_messages[] = [
                'id' => $message->id,
                'text' => $message->text,
                'reply' => (bool) $message->reply, // Convert 0/1 to boolean
                'created_at' => $message->created_at
            ];
        }

        return $formatted_messages;
    }

    public function isThreadBelongsToUser($thread_id, $user_id)
    {
        $this->db->query('SELECT COUNT(*) AS count FROM chat_threads WHERE id = :thread_id AND seeker_id = :user_id');
        $this->db->bind(':thread_id', $thread_id);
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function isThreadBelongsToRecruiter($thread_id, $recruiter_id)
    {
        $this->db->query('SELECT COUNT(*) AS count FROM chat_threads WHERE id = :thread_id AND recruiter_id = :recruiter_id');
        $this->db->bind(':thread_id', $thread_id);
        $this->db->bind(':recruiter_id', $recruiter_id);
        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkThreadExists($seeker_id, $recruiter_id)
    {
        $this->db->query('SELECT COUNT(*) AS count FROM chat_threads WHERE seeker_id = :seeker_id AND recruiter_id = :recruiter_id');
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':recruiter_id', $recruiter_id);
        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function startThread($seeker_id, $recruiter_id)
    {
        $this->db->query('INSERT INTO chat_threads (seeker_id, recruiter_id) VALUES (:seeker_id, :recruiter_id)');
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':recruiter_id', $recruiter_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getThreadId($seeker_id, $recruiter_id)
    {
        $this->db->query('SELECT id FROM chat_threads WHERE seeker_id = :seeker_id AND recruiter_id = :recruiter_id');
        $this->db->bind(':seeker_id', $seeker_id);
        $this->db->bind(':recruiter_id', $recruiter_id);

        $row = $this->db->single();

        return $row->id;
    }

    public function deleteThread($thread_id)
    {
        $this->db->query('DELETE FROM chat_threads WHERE id = :thread_id');
        $this->db->bind(':thread_id', $thread_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertMessage($thread_id, $text, $reply)
    {
        $this->db->query('INSERT INTO chat_texts (thread_id, text, reply) VALUES (:thread_id, :text, :reply)');
        $this->db->bind(':thread_id', $thread_id);
        $this->db->bind(':text', $text);
        $this->db->bind(':reply', $reply);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
