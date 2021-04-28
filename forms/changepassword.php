<form name="form"  action="resetpassword.php" method="post">
<fieldset>
<legend>
Reset Password
</legend>
<div>
	<label id="label-password" for="password" title="Enter new Password" >New Password:<span class="fg-color-redLight">*</span></label>
	<input id="password" type="password" name="password" title="Enter new Password" value="<?php echo $_POST['password']?>" maxlength="20" pattern="^.{5,20}$" required />
	<span class="fg-color-redLight" id="err-password"><?php echo $err['password']; ?></span>
</div>
<div>
	<label id="label-repassword" for="repassword" title="Retype Password" >Retype Password:<span class="fg-color-redLight">*</span></label>
	<input id="repassword" type="password" name="repassword" title="Retype Password" value="<?php echo $_POST['repassword']?>" maxlength="20" pattern="^.{5,20}$" required />
	<span class="fg-color-redLight" id="err-repassword"><?php echo $err['repassword']; ?></span>
</div>
<input type="submit" name="reset" value="Reset"/>
</fieldset>
</form>