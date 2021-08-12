<?php
include __DIR__ . "/../ogrel/functions.php";
my_session();

if(isset($_SESSION['user']) && $_SESSION['user']==='kevin') location();
elseif(isset($_SESSION['user'])) location("..");
?>
<!doctype html>
<html>
<head>
<?php 
$title = "Perguntas";
include __DIR__ . "/../ogrel/og.php"; ?>
<link rel="stylesheet" href="style.css?v2">
</head>
<body>
<h1>Login</h1>
<form id="login">
<div>
<p><i class="fa fa-user"></i> Usuário</p>
<input type="text" name="user">	
</div>
<div>
<p><i class="fa fa-key"></i> Senha</p>
<input type="password" name="password">
</div>
<button>Enviar</button>
</form>
<div id="r"></div>
<script>
$("form").submit(function(e){
	e.preventDefault();
	$.ajax({
		url:'check',
		type:'POST',
		data:$("form").serializeArray()
	}).done(function(m){
		$("#r").html(m);
	});
});
</script>
</body>
</html>
