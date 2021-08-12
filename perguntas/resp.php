<?php
if(empty($_POST)) die;
if(!in_array($_SERVER['HTTP_HOST'],array('localhost','127.0.0.1','192.168.0.117')))
session_save_path(dirname(realpath($_SERVER['DOCUMENT_ROOT'])) . "/tmp");
session_start();

$resp = +$_POST['resp'];
$p = +$_POST['pergunta'];
$n = +$_POST['nivel'];

if(isset($_SESSION['perguntas'][$n][$p-1])) {
	echo "<script>location.reload();</script>";
	die;
}

$_SESSION["perguntas"][$n][$p-1] = $resp;
echo "<script>location.reload();</script>";
?>