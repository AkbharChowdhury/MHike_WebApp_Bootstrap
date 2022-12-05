<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?= LOGO_TEXT?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if(!isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
            <a class="nav-link <?php $current_page  == 'login' ? 'active': ''?>" aria-current="page" href=".">Login</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
            </li>
            <?php else: ?>
                <li class="nav-item">
            <a class="nav-link" href="hike.php">Hike</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Search</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Sights</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="#">Upload Hike</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="logout.inc.php">Logout</a>
            </li>
                
            <?php endif ?>

        
       
      </ul>
      
    </div>
  </div>
</nav>