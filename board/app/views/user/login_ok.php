<h2>Sucessfully Logged In</h2>
<a href="<?php eh(url('user/logout')) ?>">Log Out?</a><br/>

<h3>HELLO <?php eh($_SESSION['nickname']);?></h3>

<br/><br/><br/>
<a href="<?php eh(url('thread/index')) ?>">View Threads</a>