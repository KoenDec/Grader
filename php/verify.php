<?php
require_once('php/graderdb.php');
session_start();

$userDAO = new UserDAO();

$post_data = http_build_query(
    array(
        'secret' => '6LepDTQUAAAAAAncUKYkxtmYv3e5DqatCu2SWTQ7',
        'response' => $_POST['g-recaptcha-response'],
        'remoteip' => $_SERVER['REMOTE_ADDR']
    )
);
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $post_data
    )
);
$context  = stream_context_create($opts);
$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
$captchaResult = json_decode($response);
// TODO verify pw & username => hash dis shit
$username = $_POST['username'];
$password = $_POST['password'];

$user = $userDAO->getUser($username);

if (!$captchaResult->success) {
    // TODO return a beautiful captcha is wrong err
    echo 'Incorrect captcha';
} elseif ($user->email != $username || $user->password != $password){
  // TODO return a beautiful username or pw is wrong err
  echo 'Incorrect password or username';
} elseif ($captchaResult->success && $user->email == $username && $user->password == $password){
    $_SESSION['email'] = $user->email;
    $name = $user->firstname . ' ' . $user->lastname;
    $_SESSION['name'] = $name;
    header("Refresh:0; url=index.php");
}
