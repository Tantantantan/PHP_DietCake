<?php
class User extends AppModel{

##start of validating inputs from register
    public $validation = array(
        'email' => array(
            'format' => array(
                'check_email',
            ),
        ),
##MIN and MAX values are defined in core_development.php
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
    );//end of $validation

    public function register() {
        $this->validation['email']['format'][] = $this->email;
        $this->validation['nickname']['length'][] = $this->nickname;
        $this->validation['username']['length'][] = $this->username;
        $this->validation['password']['length'][] = $this->password;
        $this->validation['confpass']['match'][] = $this->confpass;

        if(!$this->validate()) {
            throw new ValidationException("invalid inputs");
        }else {
            $input = array(
            'nickname' => $this->nickname,
            'username' => $this->username, 
            'password' => sha1($this->password), //sha1 mysql encription
            'email' => $this->email,
            );
        }
        $db = DB::conn();//storing to database    
        $db->insert('user', $input);

    }//end of register()

    public function check_login(){

        $db = DB::conn();//searcing in database
        $row = $db->row('SELECT id, nickname, username FROM user WHERE username = ? AND password = ?',
            array($this->username, $this->password)
            );

        if (!$row) {
            throw new UserNotFoundException('user not found');
        }
        return new self ($row);
    }//end of check_login

    public static function getThreads($id, $page)
    {
        $query = "SELECT t.id, t.title, u.username, t.created FROM thread t
                   INNER JOIN user u ON t.user_id = u.id WHERE t.user_id = ?";
        
        $db = DB::conn();
        $rows = $db->rows($query,array($id));
        self::$total_rows = count($rows);

        $threads = array();
        foreach ($rows as $row) {
            $threads[] = new self($row);
        }

        $limit = Pagination::max_rows;
        $offset = ($page - 1) * $limit;

        return array_slice($threads, $offset, $limit);
    }
}
?>