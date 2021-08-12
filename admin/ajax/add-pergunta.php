<?php
const MDFY_A = array("CONCRETEAND",'GOLD');
include "../../ogrel/functions.php";
my_session();

if($_SESSION['user']!=='kevin') die;

$codigo = mdfy(microtime(true).mt_rand(0,999999),MDFY_A,32);
?>
<div class="new-pergunta n1">
<div class="cabecalho">
<div class="left"><p>#</p></div>
<div class="right"><p class="deletar"><i class="fa fa-times fa-lg"></i></p></div>
</div>
<p>Enunciado</p>
<textarea name="enunciado[]" class="enunciado" placeholder="Campo opcional, caso haja um enunciado antes da pergunta."></textarea>
<p>Pergunta</p>
<textarea name="pergunta[]" class="pergunta" placeholder="Digite aqui a pergunta." rows="1"></textarea>
<p>Alternativas</p>
<div class="alternativas">
</div>
<div class="add-alternativa" data-codigo="<?=$codigo;?>"><p><i class="fa fa-plus"></i> Adicionar alternativa</p></div>
<p>Nível</p>
<select name="nivel[]">
<option value="1">1 - Amarelo</option>	
<option value="2">2 - Azul</option>
<option value="3">3 - Verde</option>
<input type="hidden" name="codigo[]" value="<?=$codigo;?>">
</select>
</div>