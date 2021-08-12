<?php
if(!in_array($_SERVER['HTTP_HOST'],array('localhost','127.0.0.1','192.168.0.117')))
session_save_path(dirname(realpath($_SERVER['DOCUMENT_ROOT'])) . "/tmp");
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
#session_regenerate_id(true);
header("Location: ../");
?>