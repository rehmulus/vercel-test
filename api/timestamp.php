<?php
function get_current_time() {
  $date = new \DateTime();
  return $date->format("Y-m-d H:i:s");
  //return time();
}

function set_timestamp(&$rezept) {
  $rezept["timestamp"] = get_current_time();
}
?>