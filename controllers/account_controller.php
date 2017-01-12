<?php
session_start();

class AccountController {
  public function register() {
    if (isset($_SESSION['user'])) {
      return call('pages', 'home');
    }

    $errors = [];
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($username && $password1 && $password2) {
      require_once('controllers/utils/form/validation.php');

      // server-side validation
      $passes_username_length = field_above_length($username, 3) && field_below_length($username, 10);
      $passes_password_length = field_above_length($password1, 6);
      $passes_password_match = fields_match($password1, $password2);
      // check username is free
      $passes_unique_username = !Account::getUser($username);

      if ($passes_username_length && $passes_password_length && $passes_password_match && $passes_unique_username) {
        // hash the password
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

        // create user account
        $created = Account::register($username, $hashed_password);

        if ($created) { echo 'created :)'; }

      } else {
        if (!$passes_username_length) { array_push($errors, 'Your username needs to be between 3 and 10 characters.'); }
        if (!$passes_password_length) { array_push($errors, 'Your password needs to be at least 6 characters long.'); }
        if (!$passes_password_match) { array_push($errors, 'Your passwords did not match.'); }
        if (!$passes_unique_username) { array_push($errors, 'The username <strong>' . $username . '</strong> is not available.'); }
      }
    }

    return require_once('views/account/register.php');
  }

  public function login() {
    if (isset($_SESSION['user'])) {
      return call('pages', 'home');
    }

    $errors = [];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
      require_once('controllers/utils/form/validation.php');

      $has_username = field_exists($username);
      $has_password = field_exists($password);

      if ($has_username && $has_password) {
        // check user exists
        $user = Account::getUser($username);

        if ($user) {
          // check password is correct
          $verified = password_verify($password, $user->password);

          if ($verified) {
            // set session
            $_SESSION['user'] = (object) [
              'username' => $user->username,
            ];

            // call self to get a refresh and activate $_SESSION
            return $this->login();

          } else {
            array_push($errors, 'Incorrect username or password.');
          }
        } else {
          array_push($errors, 'No account belonging to <strong>' . $username .'</strong> exists :/ Check you entered your username correctly.');
        }
      } else {
        array_push($errors, 'Enter both your username and password to login.');
      }
    }

    return require_once('views/account/login.php');
  }

  public function logout() {
    if (isset($_SESSION['user'])) {
      session_unset();
      session_destroy();
      call('pages', 'home');
    }
  }

  public function edit() {

  }
}