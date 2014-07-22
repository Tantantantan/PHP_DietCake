<?php
class UserController extends AppController 
{    
    /**
     *Register a new user
     */ 
    public function register()
    {
        $user = new User;
        $page = Param::get('next_page', 'register');
        $email = Param::get('email');
        $nickname = Param::get('nickname');
        $username = Param::get('username');
        $password = Param::get('password');
        $confpass = Param::get('confpass');

        switch($page) {
            case 'register':
                break;
            case 'register_ok':
                $user->email    = $email;
                $user->nickname = $nickname;
                $user->username = $username;
                $user->password = $password;
                $user->confpass = $confpass;

                try{
                    $user->register();
                } catch (ValidationException $e){
                    $page = 'register';
                }
                    break;
            
            default:
                throw new NotFoundException("{$page} not found");
                break;
        }//end of switch
        $this->set(get_defined_vars());
        $this->render($page);
    }
    /**
     *Existing user login
     */
    public function login() 
    {
        $user = new User;
        $page = Param::get('next_page', 'login');
        $trimpass = trim(Param::get('password'));
        $trimname = trim(Param::get('username'));
        
        switch ($page) {
            case 'login':
                break;
            case 'login_ok':
                $user->username = $trimname;
                $user->password = sha1($trimpass);

                try {
                    $account = $user->checkLogin();
                    $_SESSION['id'] = $account->id;
                    $_SESSION['username'] = $account->username;
                    $_SESSION['nickname'] = $account->nickname;
                } catch(UserNotFoundException $e){
                    echo "error message";
                }
                break;

            default:
                throw new NotFoundException("{$page} not found");
                break;
        }//end of switch
        $this->set(get_defined_vars());
        $this->render($page);
    }
    /**
     *User Logout
     */
    public function logout()
    {
        session_unset();
        session_destroy();
    }
}
