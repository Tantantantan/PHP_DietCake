<?php
class Comment extends AppModel
{
    public $validation = array(
        'username' => array(
            'length' => array(
                'check_length', MIN_COM_USERNAME, MAX_COM_USERNAME,
            ),
        ),
        'body' => array(
            'length' => array(
                'check_length', MIN_COM_BODY, MAX_COM_BODY,
            ),
        ),
    );
    /**
     * Get all comments of a thread from DB
     * @param $id
     * @return array
     */
    public static function get($thread_id)
    {
        $comments = array();
        
        $db = DB::conn();
        $rows = $db->rows(
            "SELECT c.id, c.thread_id, u.username, c.body, c.created
            FROM comment c INNER JOIN user u ON c.user_id = u.id
            WHERE thread_id = ? ORDER BY created ASC",
        array($thread_id)
        );

        foreach ($rows as $row) {
            $comments[] = new self($row);
        }

        return $comments;
    }
    /**
     * Insert comment to DB
     * @param $id
     */
    public function write($id)
    {
        if (!$this->validate()) {
            throw new ValidationException('invalid comment');
        }
        
        $params = array(
            "thread_id" => $id,
            "user_id" => $_SESSION['id'],
            "body" => $this->body,
            "created" => date('Y-m-d H:i:s')
        );

        $db = DB::conn();        
        $db->insert('comment', $params);
    }
}
?>