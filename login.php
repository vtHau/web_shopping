<?php
include "inc/header.php";
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check) {
	header('Location:order.php');
}
?>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['signup'])) {
	$insertCustomer = $cs->insertCustomer($_POST);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
	$loginCustomer = $cs->loginCustomer($_POST);
}
?>


<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>

			<?php
			if (isset($loginCustomer)) {
				echo $loginCustomer;
			}
			?>
			<form action="" method="POST" id="member">
				<input name="email" type="text" value="" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
				<input name="password" type="password" value="" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
				<div class="buttons">
					<div><input class="grey" type="submit" name="login">Sign In</input></div>
				</div>
			</form>
			<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
		</div>
		<div class="register_account">
			<h3>Register New Account</h3>


			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name">
								</div>

								<div>
									<input type="text" name="city" placeholder="City">
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Zip Code">
								</div>
								<div>
									<input type="text" name="email" placeholder="Email">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Address">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="VI">TPHCM</option>
									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Number phone">
								</div>

								<div>
									<input type="text" name="password" placeholder="Password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div>
						<input type="submit" name="signup" class"grey" value="Dang Ky" style=" background: #ffffff;" />
					</div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
			<?php
			if (isset($insertCustomer)) {
				echo $insertCustomer;
			}
			?>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include "inc/footer.php";
?>