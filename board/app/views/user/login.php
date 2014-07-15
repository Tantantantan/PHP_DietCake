<div align="center">
<h2>User Log In</h2>

<form method="POST" action="<?php eh(url('user/login'))?>">

<label>Username:</label>
  <input type="text" name="username">
  
<label>Password:</label>
  <input type="password" name="password">
  <input type="hidden" name="next_page" value="login_ok">
  <br />
  <button type="submit">Submit</button>
</form>

New User?
<a href="<?php eh(url('user/register')) ?>">Register Here</a>
</div>