<?php
$title = 'Add/Edit User Accounts';
$baseUrl = '../';
require_once('../layouts/header.blade.php');
if ($user["role"] != "1") {
	header('Location: ../');
}

$id = $msg = $fullname = $username = $email = $phone_number = $address = $role_id = '';
require_once('form_save.php');

$id = getGet('id');
if ($id != '' && $id > 0) {
	$sql = "select * from db_user where id = '$id'";
	$userItem = executeResult($sql, true);
	if ($userItem != null) {
		$fullname = $userItem['fullname'];
		$username = $userItem['username'];
		$email = $userItem['email'];
		$phone_number = $userItem['phone'];
		$address = $userItem['address'];
		$role_id = $userItem['role'];
	} else {
		$id = 0;
	}
} else {
	$id = 0;
}

$sql = "select * from db_usergroup";
$roleItems = executeResult($sql);
?>

<div class="row" style="margin-top: 48px;">
	<div class="col-md-12 table-responsive">
		<h3>Add/Edit User Accounts</h3>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h5 style="color: red;"><?= $msg ?></h5>
			</div>
			<div class="panel-body">
				<form method="post" onsubmit="return validateForm();">
					<div class="form-group">
						<label class="mt-3 mb-2" for="usr">Full Name</label>:</label>
						<input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?= $fullname ?>">
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
					</div>
					<div class="form-group">
						<label class="mt-3 mb-2" for="usr">Username:</label>
						<input type="text" class="form-control" id="usrn" name="username" value="<?= $username ?>" <?= ($id != '' && $id > 0)?"disabled":"" ?>>
					</div>
					<div class="form-group">
						<label class="mt-3 mb-2" for="usr">Role:</label>
						<select class="form-control" name="role_id" id="role_id" required="true">
							<option value="">-- Select --</option>
							<?php
							foreach ($roleItems as $role) {
								if ($role['id'] == $role_id) {
									echo '<option selected value="' . $role['id'] . '">' . $role['name'] . '</option>';
								} else {
									echo '<option value="' . $role['id'] . '">' . $role['name'] . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="mt-3 mb-2" for="email">Email:</label>
						<input required="true" type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
					</div>
					<div class="form-group">
						<label class="mt-3 mb-2" for="phone_number">Phone Number:</label>
						<input required="true" type="tel" class="form-control" id="phone_number" name="phone_number" value="<?= $phone_number ?>">
					</div>
					<div class="form-group">
						<label class="mt-3 mb-2" for="address">Address:</label>
						<input required="true" type="text" class="form-control" id="address" name="address" value="<?= $address ?>">
					</div>
					<div class="form-group">
						<label class="mt-3 mb-2" for="pwd">Password</label>:</label>
						<input <?= ($id > 0 ? '' : 'required="true"') ?> type="password" class="form-control" id="pwd" name="password" minlength="6">
					</div>
					<div class="form-group">
						<label class="mt-3 mb-2" for="confirmation_pwd">Password Verification:</label>
						<input <?= ($id > 0 ? '' : 'required="true"') ?> type="password" class="form-control" id="confirmation_pwd" minlength="6">
					</div>
					<button class="btn btn-success my-3">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function validateForm() {
		$pwd = $('#pwd').val();
		$confirmPwd = $('#confirmation_pwd').val();
		if ($pwd != $confirmPwd) {
			alert("Password does not match, please check again")
			return false
		}
		return true
	}
</script>

<?php
require_once('../layouts/footer.blade.php');
?>
