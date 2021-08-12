<?php
include "../../ogrel/functions.php";
my_session();

if($_SESSION['user']!=='kevin') die;

$perguntas = array();
foreach($_POST['pergunta'] as $i => $pp):

$codigo = $_POST['codigo'][$i];

$perguntas[$codigo]['enunciado'] = !empty($_POST['enunciado'][$i]) ? sanitizar($_POST['enunciado'][$i]) : false;
$perguntas[$codigo]['pergunta'] = !empty($pp) ? sanitizar($_POST['pergunta'][$i]) : false;
$perguntas[$codigo]["alternativas"] = is_array($_POST["alternativa_{$codigo}"]) && !empty($_POST["alternativa_{$codigo}"]) ? $_POST["alternativa_{$codigo}"] : false;

if($perguntas[$codigo]['pergunta']===false || $perguntas[$codigo]["alternativas"]===false)  {
	unset($perguntas[$codigo]);
	continue;
}

$alternativas = array_map("sanitizar",$alternativas);

$alt_id = array_filter($_POST['alternativas'],function($x){
	global $codigo;
	if(preg_match("%^{$codigo}:%",$x)) return $x;
});
$alt_id = array_values($alt_id);

$correta = $_POST["correta_{$codigo}"];
$correta = array_search("{$codigo}:{$correta}",$alt_id);

$perguntas[$codigo]['resposta'] = $correta;
$perguntas[$codigo]['nivel'] = $_POST['nivel'][$i];
endforeach;

$perguntas = array_values($perguntas);

$json = json_encode($perguntas,JSON_UNESCAPED_UNICODE);
file_put_contents("../../perguntas/403/perguntas.json",$json);

blankrerro("./enviadas");

function sanitizar($x) {
	$x = trim($x);
	$x = preg_replace("%\r?\n%uis","<br>",$x);
	return strip_tags($x,"<br><strong><b><i><em><s><del><strike><u>");
}
?>