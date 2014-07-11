<div align="center">
<h2>User Registration</h2>
</div>
<?php if ($user->hasError()): ?>	 
Validation Error!
<div align="center">
		<?php if (!empty($user->validation_errors['nickname']['format'])): ?>
    	Nick name must contain letters only.
  		<?php endif ?>

		<?php if (!empty($user->validation_errors['email']['format'])): ?>
		Invalid Email Address.
		<?php endif?>

		<?php if (!empty($user->validation_errors['username']['length'])): ?>
		User Name must be between:
		<?php eh($user->validation['username']['length'][1]) ?> and
		<?php eh($user->validation['username']['length'][2]) ?> characters in length.
		<?php endif?>

		<?php if (!empty($user->validation_errors['password']['length'])): ?>
		Password must be between:
		<?php eh($user->validation['password']['length'][1]) ?> and
		<?php eh($user->validation['password']['length'][2]) ?> characters in length.
		<?php endif?>

		<?php if (!empty($user->validation_errors['confpass']['match'])): ?>
		Password does not match.
		<?php endif ?>
</div>
<?php endif ?>

<form action="<?php eh(url('user/register')) ?>" method='post'>

<div align = "center">

	<label for='nickname'> Nick Name: </label>
	<input type='text' name='nickname' maxlength="10" 
	value='<?php eh(Param::get("nickname"))?>'/>
	  
	<label for='email'> Email Address:</label>
	<input type='text' name='email' maxlength="50" 
	value='<?php eh(Param::get("email"))?>'/>
	
	<label for='username'> UserName:</label>
	<input type='text' name='username' maxlength="20" 
	value='<?php eh(Param::get("username"))?>'/>
	
	<label for='password'> Password:</label>
	<input type='password' name='password' maxlength="20" 
	value='<?php eh(Param::get("password"))?>'/>

	<label for='confpass'> Confirm Password:</label>
	<input type='password' name='confpass' maxlength="20" 
	value='<?php eh(Param::get("confpass"))?>'/>
	
	<br/>
	<input type='submit' name='Submit' value='Submit' />

	<br/><br/>
	Back to login?
	<a href="<?php eh(url('user/login')) ?>"> Login Here</a>
</div>
<!--will pass to controller for a new user-->
<input type="hidden" name="next_page" value="register_ok">
</form>