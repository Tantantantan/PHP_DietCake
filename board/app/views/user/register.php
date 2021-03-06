<div align="center">
<h2>User Registration</h2>
</div>
<?php if ($user->hasError()): ?>	 
<font size="3" color="red">Validation Error!</font>
<div align="center">
    <?php if (!empty($user->validation_errors['nickname']['format'])): ?>
    <font size="3" color="red">Nick name must contain letters only.</font><br/>
    <?php endif ?>

    <?php if (!empty($user->validation_errors['email']['format'])): ?>
    <font size="3" color="red">Invalid Email Address.</font><br/>
    <?php endif?>

    <?php if (!empty($user->validation_errors['username']['length'])): ?>
    <font size="3" color="red">User Name must be between:
    <?php eh($user->validation['username']['length'][1]) ?> and
    <?php eh($user->validation['username']['length'][2]) ?> characters in length.
    </font><br/>
    <?php endif?>

    <?php if (!empty($user->validation_errors['password']['length'])): ?>
    <font size="3" color="red">User Name must be between:Password must be between:
    <?php eh($user->validation['password']['length'][1]) ?> and
    <?php eh($user->validation['password']['length'][2]) ?> characters in length.
    </font><br/>
    <?php endif?>

    <?php if (!empty($user->validation_errors['confpass']['match'])): ?>
    <font size="3" color="red">
    Password does not match.
    </font><br/>
    <?php endif ?>
</div>
<?php endif ?>

<form action="<?php eh(url('user/register')) ?>" method='post'>
<div align = "center">

    <label for='nickname'> Nick Name: </label>
    <input type='text' name='nickname' maxlength="10" 
    value='<?php eh($nickname)?>'/>
      
    <label for='email'> Email Address:</label>
    <input type='text' name='email' maxlength="50" 
    value='<?php eh($email)?>'/>

    <label for='username'> UserName:</label>
    <input type='text' name='username' maxlength="20" 
    value='<?php eh($username)?>'/>

    <label for='password'> Password:</label>
    <input type='password' name='password' maxlength="20" 
    value='<?php eh($password)?>'/>

    <label for='confpass'> Confirm Password:</label>
    <input type='password' name='confpass' maxlength="20" 
    value='<?php eh($confpass)?>'/>

    <br/>
    <input type='submit' name='Submit' value='Submit' />

    <br/><br/>
    Back to login?
    <a href="<?php eh(url('user/login')) ?>"> Login Here</a>
</div>
<!--will pass to controller for a new user-->
<input type="hidden" name="next_page" value="register_ok">
</form>
