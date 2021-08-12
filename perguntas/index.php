<?php
if(!in_array($_SERVER['HTTP_HOST'],array('localhost','127.0.0.1','192.168.0.117')))
session_save_path(dirname(realpath($_SERVER['DOCUMENT_ROOT'])) . "/tmp");
session_start();

if((!isset($_GET['n']) || empty($_GET['n']) || !is_numeric($_GET['n'])) &&
(!isset($_GET['p']) || empty($_GET['p']) || !is_numeric($_GET['p']))) {
	header("Location: ../");
	die;
} 
$n = +$_GET['n'];
$p = +$_GET['p'];

$json = json_decode(file_get_contents("403/perguntas.json"),true);
$json = array_filter($json,function($x){
	global $n;
	if(+$x['nivel']===$n) return $x;
});
$json = array_values($json);

if(!isset($json[$p-1])) {
	header("Location: ../");
	die;
}
$json = $json[$p-1];

$pergunta = &$json['pergunta'];
$enunciado = &$json['enunciado'];
$alternativas = &$json['alternativas'];
?>
<!doctype html>
<html>
<head>
<?php 
$title = "Quiz de Direito Penal - Pergunta #{$n}";
include __DIR__ . "/../ogrel/og.php"; ?>
</head>
<body>
<a href="../"><p><i class="fa fa-arrow-left"></i> Voltar</p></a>
<h1 class="<?="n{$n}";?>">Pergunta #<?php 
echo $p;
if($n===1) echo " - Amarela";
elseif($n===2) echo " - Azul";
elseif($n===3) echo " - Verde";
if($n===1) echo " (1 ponto)";
else echo " ({$n} pontos)";
?></h1>
<?php if($enunciado): ?>
<p class="enunciado"><?=$enunciado;?></p>
<?php endif; ?>
<p class="pergunta <?="n{$n}";?>"><?=$pergunta;?></p>
<?php
if(isset($_SESSION['perguntas'][$n][$p-1])) {
	include "result.php";
	die;
}	
?>
<form>
<div id="alternativas">
<?php foreach($alternativas as $i => $aa): ?>
<div class="alternativa">
<input type="radio" name="resp" value="<?=$i;?>">
<i class="fa fa-square fa-lg"></i>
<p><?=$aa;?></p>
</div>
<?php endforeach; ?>
</div>
<input type="hidden" name="nivel" value="<?=$n;?>">
<input type="hidden" name="pergunta" value="<?=$p;?>">
<button>Enviar</button>
</form>
<div id="r"></div>
<a href="../"><p><i class="fa fa-arrow-left"></i> Voltar</p></a>
<script>
$(".alternativa").on("click",function(){
	$("input[type=radio]").attr("checked",false);
	$(this).children("input").attr("checked",true);
	$(".alternativa").removeClass("selecionada");
	$(this).addClass("selecionada");
	$(".alternativa").find("i").removeClass("fa-check-square").addClass("fa-square");
	$(this).find("i").addClass("fa-check-square").removeClass("fa-square");
});
$("form").submit(function(e){
	e.preventDefault();
	$.ajax({
		url:'resp.php',
		type:'POST',
		data:$(this).serializeArray()
	}).done(function(m){
		$("#r").html(m);
	});
});
</script>
</body>
</html>
