<?php
  $apc_key = "{$_SERVER['SERVER_NAME']}~login:{$_SERVER['REMOTE_ADDR']}";
  $apc_blocked_key = "{$_SERVER['SERVER_NAME']}~login-blocked:{$_SERVER['REMOTE_ADDR']}";

  $tries = (int)apc_fetch($apc_key);
  if ($tries >= 10) {
    header("HTTP/1.1 429 Too Many Requests");
    echo "You've exceeded the number of login attempts. We've blocked IP address {$_SERVER['REMOTE_ADDR']} for a few minutes.";
    exit();
  }

  $success = login($_POST['username'], $_POST['password']);
  if (!$success) {
    $blocked = (int)apc_fetch($apc_blocked_key);

    apc_store($apc_key, $tries+1, pow(2, $blocked+1)*60);  # store tries for 2^(x+1) minutes: 2, 4, 8, 16, ...
    apc_store($apc_blocked_key, $blocked+1, 86400);  # store number of times blocked for 24 hours
  } else {
    apc_delete($apc_key);
    apc_delete($apc_blocked_key);
  }
