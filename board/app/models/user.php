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
    public function register($user) 
    {
        $this->validation['email']['format'][] = $this->email;
        $this->validation['nickname']['length'][] = $this->nickname;
        $this->validation['username']['length'][] = $this->username;
        $this->validation['password']['length'][] = $this->password;
        $this->validation['confpass']['match'][] = $this->confpass;

        if(!$this->validate()){
            throw new ValidationException("invalid inputs");
        }else{
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
        $row = $db->row('SELECT id, nickname, username FROM user WHERE username = ? AND password = ?',
            array($this->username, $this->password)
            );

        if (!$row){
            throw new UserNotFoundException('user not found');
        }
        return new self ($row);
    }
}
?>