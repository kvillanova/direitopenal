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
<form>
<div id="admin-perguntas"></div>
<div id="add-pergunta"><p><i class="fa fa-plus"></i> Adicionar pergunta</p></div>
<button type="submit" class="salvar">Salvar</button>
</form>
<div id="r"></div>
<script>
$("form").submit(function(e){
	e.preventDefault();
	$.ajax({
		url:'ajax/salvar.php',
		type:'POST',
		data:$(this).serializeArray()
	}).done(function(m){
		$("#r").html(m);	
	});
});
	
$("#add-pergunta").click(function(e){
	$.ajax({
		url:'ajax/add-pergunta.php',
		type:'POST'
	}).done(function(m){
		$("#admin-perguntas").append(m);
	});
});
$(document).on("click",".add-alternativa",function(e){
	var codigo = $(this).data("codigo");
	var alts = $(this).siblings(".alternativas");
	$.ajax({
		url:'ajax/add-alternativa.php',
		type:'POST',
		data:{codigo:codigo}
	}).done(function(m){
		alts.append(m);
	});
});
	
$(document).on("click",".trash",function(e){
	$(this).parents(".alternativa").remove();
});
	
$(document).on("click",".deletar",function(e){
	$(this).parents(".new-pergunta").remove();
});
	
$(document).on("click",".checkbox",function(e){
	$(this).siblings("input[type=radio]").prop("checked",true);
	$(".checkbox").each(function(){
		var input = $(this).siblings("input[type=radio]");
		
		if(input.prop("checked")) $(this).find("i").removeClass("fa-square").addClass("fa-check-square");
		else $(this).find("i").removeClass("fa-check-square").addClass("fa-square");
	});
});
	
$(document).on("click",".letra",function(e){
	$(this).siblings("label.checkbox").trigger("click");
});
	
$(document).on("change",".new-pergunta select",function(e){
	var n = $(this).val();
	$(this).parents(".new-pergunta").removeClass("n1 n2 n3").addClass("n"+n);
});

<?php if(!$json): ?>
$("#add-pergunta").trigger("click");
<?php else: ?>
$.ajax({
	url:'ajax/get-perguntas.php',
	type:'POST'
}).done(function(m){
	$("#admin-perguntas").html(m);
});
	
$(document).on("keyup","textarea",function(){
	var h = this.scrollHeight-20;
	var r = h/22;
	this.rows = r;
});
<?php endif; ?>
</script>
</body>
</html>
