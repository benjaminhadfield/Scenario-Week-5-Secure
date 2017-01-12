<header class="mb-4 py-2 bg-silver">
  <div class="container-fluid">
    <p class="m-0">
      <?php if (isset($_SESSION['user'])) { ?>
        Welcome back <strong><?php echo $_SESSION['user']->username ?></strong>! <a href="?controller=account&action=logout">Logout</a>.
      <?php } else { ?>
        <a href="?controller=account&action=login">Login</a> or <a href="?controller=account&action=register">Register</a> to get started.
      <?php } ?>
    </p>
  </div>
</header>