<?php
/** needed for dev cors preflight */
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  die();
}

require_once './check-password.php';
check_userdata();
echo json_encode(["login" => true], JSON_UNESCAPED_UNICODE);
?>