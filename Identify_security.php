 <?php

$header = ‘From: ‘ . $_Get[‘from’] . \’’r\’’n\ .
‘Reply-to: . $-Get[‘replyto’] . \’’r\’’n\ .
$Mail = mail($_Get[‘to’],$_Get[‘Subject’],$_Get[‘Message’],$header);

?>
