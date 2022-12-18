<?php
function die_with_401() {
  http_response_code(401);
  die();
}

function check_userdata() {
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    die();
  }

  include './init-db.php';

  if(!$_SERVER["HTTP_USERNAME"] || !$_SERVER["HTTP_PASSWORD"]){
    die_with_401();
  }
  $user = $_SERVER["HTTP_USERNAME"];
  $password = $_SERVER["HTTP_PASSWORD"];
  $user_data = $userdataStore->findBy(["username", "=", $user])[0];
  $passwords_match = password_verify($password, $user_data['password_hash']);
  if(!$passwords_match){
    die_with_401();
  }
}
?>