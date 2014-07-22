<?php
class User extends AppModel
{
    /**
     *MIN and MAX values are defined in core.php
     */
    public $validation = array(
        'email' => array(
            'format' => array(
                'check_email',
            ),
        ),
        
        'nickname' => array(
            'length' => array(
                'check_length', MIN_USER_LENGTH, MAX_USER_LENGTH
            ),
        ),

        'username' => array(
            'length' => array(
                'check_length', MIN_USER_LENGTH, MAX_USER_LENGTH
            ),
        ),

        'password' => array(
            'length' => array(
                'check_length', MIN_PASS_LENGTH, MAX_PASS_LENGTH
            ),
        ),

        'confpass' => array(
            'match' => array(
                'check_password',
            ),
        ),
    );
    /**
     *Get user Inputs
     */
    public function register() 
    {
        if(!$this->validate()) {
            throw new ValidationException("invalid inputs");
        }

        $input = array(
            'nickname' => $this->nickname,
            'username' => $this->username, 
            'password' => sha1($this->password), //sha1 mysql encription
            'email' => $this->email,
        );
        
        }
        $db = DB::conn();//storing to database    
        $db->insert('user', $input);
    }
    /**
     *Log in and get if existing in database
     *@return $row
     */
    public function checkLogin()
    {
        $db = DB::conn();//searcing in database
        $query = 'SELECT id, nickname, username FROM user WHERE username = ? AND password = ?'
        $row = $db->row($query,
            array($this->username, $this->password)
            );

        if (!$row) {
            throw new UserNotFoundException('user not found');
        }
        return self ($row);
    }
    /**
     *get Threads from database
     */
    public static function getThreads($id, $page)
    {
        $query = "SELECT t.id, t.title, u.username, t.created FROM thread t
                   INNER JOIN user u ON t.user_id = u.id WHERE t.user_id = ?";
        
        $db = DB::conn();
        $rows = $db->rows($query, array($id));
        self::$total_rows = count($rows);

        $threads = array();
        foreach ($rows as $row) {
            $threads[] = new self($row);
        }

        $limit = Pagination::MAX_ROWS;
        $offset = ($page - 1) * $limit;

        return array_slice($threads, $offset, $limit);
    }
}
?>
