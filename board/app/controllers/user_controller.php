<?php
class UserController extends AppController {
    
    public function register() {
        $user = new User;
        $page = Param::get('next_page','register');

        switch($page){
            case 'register':
                break;
            case 'register_ok':
                $user->email    = Param::get('email');
                $user->nickname = Param::get('nickname');
                $user->username = Param::get('username');
                $user->password = Param::get('password');
                $user->confpass = Param::get('confpass');
                try{
                $user->register();
                }catch (ValidationException $e){
                $page = 'register';
                }break;
            
            default:
                throw new NotFoundException("{$page} not found");
                break;
        }//end of switch
        $this->set(get_defined_vars());
        $this->render($page);
    }//end of register

    public function login() {
        $user = new User;
        $page = Param::get('next_page', 'login');

        switch ($page) {
            case 'login':
                break;
            case 'login_ok':
                $user->username = Param::get('username');
                $user->password = sha1(Param::get('password'));
                try {
                $account = $user->check_login($user->username, $user->password);
                $_SESSION['id'] = $account['id'];
                $_SESSION['username'] = $account['username'];
                $_SESSION['nickname'] = $account['nickname'];
                } catch(UserNotFoundException $e) {
                $page = 'login';
                }
                break;

            default:
                throw new NotFoundException("{$page} not found");
                break;
        }//end of switch
        $this->set(get_defined_vars());
        $this->render($page);
    }//end of login

    public function logout() {
        session_unset();
        session_destroy();
    }
}
?>