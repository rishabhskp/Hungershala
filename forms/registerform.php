<form name="form" action="<?php echo $PHP_SELF; ?>" method="post" onsubmit="return signup()">
<fieldset>
<legend>Hungry? Register Now!</legend>
<div>
	<div class="input-control text span3">
	<input type="text" id="name" name="name" title="Enter your Full Name" placeholder="Full Name" value="<?php echo $val['name']?>" autofocus required />
	<button class="btn-clear" > </button>
	</div>
	<span class="fg-color-redLight" id="err-name"><?php echo $err['name']; ?></span>
</div>
<div>	
	<div class="input-control text span3">
	<input id="email" type="email" name="email" title="Enter your email address" placeholder="Email Address" value="<?php echo $val['email']?>" />
	<button class="btn-clear" > </button>
	</div>
	<span class="fg-color-redLight" id="err-email"><?php echo $err['email']; ?></span>
</div>
<div>
	<div class="input-control password span3">
	<input id="password" type="password" name="password" title="Minimum 5 char long" placeholder="Password" value="<?php echo $val['password']?>" maxlength="20" pattern="^.{5,20}$" required />
	<button class="btn-reveal"></button>
	</div>
	<span class="fg-color-redLight" id="err-password"><?php echo $err['password']; ?></span>
</div>
<div>
	<div class="input-control text span3">
	<input type="text" id="rollno" name="rollno" title="Your 9 digit college roll number" placeholder="Roll Number" value="<?php echo $val['rollno']?>" maxlength="9" pattern="^\d{9}$" required/>
	<button class="btn-clear" > </button>
	</div>
	<span class="fg-color-redLight" id="err-rollno"><?php echo $err['rollno']; ?></span>
</div>
<div>
	<div class="input-control select span3">
	<select id="hostel" name="hostel" title="Where do you want your food to be delivered?">
		<option id="Hostel" value="Hostel" disabled selected>Hostel</option>
		<option id="Agate" value="Agate">Agate</option>
		<option id="Amber-A" value="Amber-A">Amber-A</option>
		<option id="Amber-B" value="Amber-B">Amber-B</option>
		<option id="Aquamarine-A" value="Aquamarine-A">Aquamarine-A</option>
		<option id="Aquamarine-B" value="Aquamarine-B">Aquamarine-B</option>
		<option id="Aquamarine-C" value="Aquamarine-C">Aquamarine-C</option>
		<option id="Coral" value="Coral">Coral</option>
		<option id="Diamond" value="Diamond">Diamond</option>
		<option id="Jade" value="Jade">Jade</option>
		<option id="Garnet-A" value="Garnet-A">Garnet-A</option>
		<option id="Garnet-B" value="Garnet-B">Garnet-B</option>
		<option id="Garnet-C" value="Garnet-C">Garnet-C</option>
		<option id="Emerald" value="Emerald">Emerald</option>
		<option id="Lapis" value="Lapis">Lapis</option>
		<option id="Pearl" value="Pearl">Pearl</option>
		<option id="Ruby" value="Ruby">Ruby</option>
		<option id="Sapphire" value="Sapphire">Sapphire</option>
		<option id="Topaz" value="Topaz">Topaz</option>
		<option id="Opal-A" value="Opal-A">Opal-A</option>
		<option id="Opal-B" value="Opal-B">Opal-B</option>
		<option id="Opal-C" value="Opal-C">Opal-C</option>
		<option id="Opal-D" value="Opal-D">Opal-D</option>
		<option id="Opal-E" value="Opal-E">Opal-E</option>
		<option id="Zircon-A" value="Zircon-A">Zircon-A</option>
		<option id="Zircon-B" value="Zircon-B">Zircon-B</option>
		<option id="Zircon-C" value="Zircon-C">Zircon-C</option>
	</select>
	</div>
	<span class="fg-color-redLight" id="err-hostel"><?php echo $err['hostel']; ?></span>
</div>
<div>
	<div class="input-control text span3">
	<input id="mobile" type="phone" name="mobile" maxlength="10" pattern="^[789]\d{9}$" title="Enter your 10-digit mobile number" placeholder="Mobile Number" value="<?php echo $val['mobile']?>"/>
	<button class="btn-clear" > </button>
	</div>
	<span class="fg-color-redLight" id="err-mobile"><?php echo $err['mobile']; ?></span>
</div>
<input type="submit" value="Submit" name="submit"/>
</fieldset>
</form>