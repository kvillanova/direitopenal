<?php
include __DIR__ . "/../ogrel/functions.php";
my_session();

if($_SESSION['user']!=='kevin') location("login");

$json = file_exists("../perguntas/403/perguntas.json") ? json_decode(file_get_contents("../perguntas/403/perguntas.json"),true) : false;
if($json) {
	usort($json,function($a,$b){
		return +$a['nivel']<=>+$b['nivel'];
	});
}
?>
<!doctype html>
<html>
<head>
<?php 
$title = "Perguntas";
include __DIR__ . "/../ogrel/og.php"; ?>
<link rel="stylesheet" href="style.css?v=<?=microtime();?>">
</head>
<body>
<header>
<div class="left">
<h2>Admin//</h2>
<a href="./"><p><i class="fa fa-question-circle"></i> Perguntas</p></a>
</div>
<div class="right">
<p>Bem-vindo, Kevin.</p>	
</div>
</header>
<h1><i class="fa fa-question-circle"></i> Perguntas</h1>
<div class="w3-panel w3-green">
	<p>Perguntas enviadas com sucesso!</p>
</div>
</body>
</html>
