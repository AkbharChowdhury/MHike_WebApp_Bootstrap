<?php
$current_page = 'login';
$page_title = 'Login';
require_once 'templates/header.php';
require_once 'classes/database.class.php';
require_once 'classes/Helper.class.php';
require_once 'includes/register.inc.php';

?>


<div class="container pt-2">

<?php require_once 'includes/session_message.inc.php'?>
    <div class="mb-2">
    <img src="images/logo.png" class="img-fluid" alt="Logo" width="100" height="100">
    <h3 class="text-warning text-capitalize"><?=LOGO_TEXT?> register</h3>

    </div>
<form class="needs-validation" novalidate method="post" action="">


<div class="form-floating mb-3">
  <input type="text" class="form-control" name="firstname" id="firstname" placeholder="name@example.com" required value="<?= $_POST['firstname'] ?? ''?>">
  <label for="firstname">Firstname</label>
  <div class="invalid-feedback">
      Firstname is required.
    </div>
</div>


<div class="form-floating mb-3">
  <input type="text" class="form-control" name="lastname" id="lastname" placeholder="name@example.com" required value="<?= $_POST['lastname'] ?? ''?>">
  <label for="lastname">Lastname</label>
  <div class="invalid-feedback">
      Lastname is required.
    </div>
</div>



<div class="form-floating mb-3">
  <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required value="<?= $_POST['email'] ?? ''?>">
  <label for="email">Email</label>
  <div class="invalid-feedback">
      Email is required.
    </div>
</div>


<div class="form-floating">
  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required value="<?= $_POST['password'] ?? ''?>">
  <label for="password">Password</label>
  <div class="invalid-feedback">
      Password is required.
    </div>
</div>
  <div class="mt-3">
  <button type="submit" class="btn btn-warning text-capitalize">register</button>
  </div>
</form>
</div>

<?php require_once 'templates/footer.php'; ?>
