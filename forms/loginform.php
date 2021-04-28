<form name="form"  action="<?php echo $PHP_SELF; ?>" method="post" onsubmit="return login()">
<fieldset>
<legend>
Sign In
</legend>
<div>
	<div class="input-control text span3">
	<input id="username" type="text" name="username" title="Enter email or rollno to login" placeholder="Email / Rollno" value="<?php echo $_POST['username']?>" pattern="([a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z]+)*|\d{9})" autofocus required />
	<button class="btn-clear" > </button>
	</div>
	<span class="fg-color-redLight" id="err-username"><?php echo $err['username']; ?></span>
</div>
<div>
	<div class="input-control password span3">
	<input id="password" type="password" name="password" title="Enter your password" placeholder="Password" value="<?php echo $_POST['password']?>" maxlength="20" pattern="^.{5,20}$" required />
	<button class="btn-reveal"></button>
	</div>
	<span class="fg-color-redLight" id="err-password"><?php echo $err['password']; ?></span>
</div>
<div class="fg-color-redLight" id="err-login"><?php echo $err['login']; ?></div>
<input type="submit" name="signin" value="Log In"/>
<a href="#" id="forgot" onclick="forgot()">Forgot Password?</a>
</fieldset>
</form>
