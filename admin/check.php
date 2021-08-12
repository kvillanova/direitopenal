<?php
const MDFY_A = ["&AS&D&*ASXSASX*&*&SS(@*!(@(*@(*()))))","A()S()(SA)(*@**!*)@(#*!(X11120291!))"];
include __DIR__ . "/../ogrel/functions.php";
my_session();

if(!isset($_POST)) die;
extract($_POST,EXTR_SKIP);

$user = mb_strtolower($user);
if($user!=='kevin') rerro("Usuário não encontrado.");

if(mdfy($password,MDFY_A,32)!=="670f8eb9c3861490babc9521864027fd") rerro("Senha incorreta.");

$_SESSION['user'] = 'kevin';
blankrerro();
?>