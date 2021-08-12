<?php
if(!in_array($_SERVER['HTTP_HOST'],array('localhost','127.0.0.1','192.168.0.117')))
session_save_path(dirname(realpath($_SERVER['DOCUMENT_ROOT'])) . "/tmp");
session_start();
?>
<!doctype html>
<html>
<head>
<?php 
$title = "Quiz de Direito Penal";
include __DIR__ . "/ogrel/og.php"; ?>
</head>
<body>
<h1>Quiz de Direito Penal</h1>
<?php
$json = file_exists("perguntas/403/perguntas.json") ? json_decode(file_get_contents("perguntas/403/perguntas.json"),true) : false;
if(!$json) {
	echo "<p>Não há perguntas cadastradas.</p></body></html>";
	die;
}
usort($json,function($a,$b){
	return $a["nivel"]<=>$b["nivel"];
});
?>
<div id="perguntas">
<?php 
$N=$I=0;	
foreach($json as $jj): 
if($N<$jj['nivel']) {
	$N = $jj['nivel'];
	$I=0;
}
++$I;
?>
<div class="pergunta n<?php
echo $N;
if(isset($_SESSION["perguntas"][$N][$I-1])) echo " perguntada";	
?>" data-destino="<?="{$N}-{$I}";?>"><p><?=$I;?></p></div>
<?php endforeach; ?>
</div>
<script>
$(".pergunta").click(function(e){
	location.href = './perguntas/' + $(this).data("destino");
});
</script>
</body>
</html>
