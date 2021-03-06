<?php
class Thread extends AppModel
{
    public $validation = array(
        'title' => array(
            'length' => array(
                'validate_length', MIN_THREAD_LENGTH, MAX_THREAD_LENGTH,
            ),
        ),
    );
    /**
     *Get a Thread
     *@param $id
     *@return $row
     */
    public static function get($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));

        return new self($row);
    }
    /**
     *Get all Threads
     *@return Threads
     */
    public static function getAll()
    {
        $threads = array();
        $limit = 'LIMIT ' . (Pagination::$current_page - 1) * Pagination::MAX_ROWS . ',' . Pagination::MAX_ROWS;
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM thread {$limit}");

        foreach ($rows as $row) {
            $threads[] = new self($row);
        }

        return $threads;
    }
    /**
     *get Comments from database
     */
    public function getComments()
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM comment WHERE thread_id = ? ORDER BY created', array($this->id));

        foreach ($rows as $row) {
            $comments[] = new Comment($row);
        }
        return $comments;
    }
    /**
     *Create comments
     *@param $commentitch
     */
    public function create(Comment $comment)
    {
        $this->validate();
        $comment->validate();
        if ($this->hasError() || $comment->hasError()) {
            throw new ValidationException('invalid thread or comment');
        }

        $db = DB::conn();
        $db->begin();

        $db->query('INSERT INTO thread SET title = ?, created = NOW()', array($this->title));
        $this->id = $db->lastInsertId();

        // write first comment at the same time
        $this->write($comment);

        $db->commit();
    }
    /**
     *write comment to database
     *@param $comment
     */
    public function write(Comment $comment)
    {
        if (!$comment->validate()) {
            throw new ValidationException('invalid comment');
        }

        $db = DB::conn();
        $query_update = 'INSERT INTO comment SET thread_id = ?, username = ?, body = ?, created = NOW()';
        $db->query($query_update, array($this->id, $comment->username, $comment->body));
    }
    /**
     *Get the number of Threads
     */
    public static function countThreads(){
        $db = DB::conn();
        $thread_count = $db->value('SELECT COUNT(id) FROM thread');
        return $thread_count;
    }
}
