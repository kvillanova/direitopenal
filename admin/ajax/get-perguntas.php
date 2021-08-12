<?php
const MDFY_A = array("CONCRETEAND",'GOLD');
const MDFY_A2 = array("ALTCOD",'NUMBER10');
include "../../ogrel/functions.php";
my_session();

if($_SESSION['user']!=='kevin') die;

$json = file_exists("../../perguntas/403/perguntas.json") ? json_decode(file_get_contents("../../perguntas/403/perguntas.json"),true) : false;
if(!$json) die("NO JSON");

foreach($json as $x => $jj):

$codigo = mdfy($x."-".microtime(true),MDFY_A,32);
?>
<div class="new-pergunta n<?=$jj['nivel'];?>">
<div class="cabecalho">
<div class="left"><p>#</p></div>
<div class="right"><p class="deletar"><i class="fa fa-times fa-lg"></i></p></div>
</div>
<p>Enunciado</p>
<textarea name="enunciado[]" class="enunciado" placeholder="Campo opcional, caso haja um enunciado antes da pergunta." rows="1"><?php if(isset($jj['enunciado']) && $jj['enunciado']) echo $jj['enunciado'];?></textarea>
<p>Pergunta</p>
<textarea name="pergunta[]" class="pergunta" placeholder="Digite aqui a pergunta." rows="1"><?=$jj['pergunta'];?></textarea>
<p>Alternativas</p>
<div class="alternativas">
<?php foreach($jj['alternativas'] as $c => $aa): 
$altcode = mdfy($x."-".$c."-".microtime(true),MDFY_A2,32);
?>
<div class="alternativa">
<?php if($c===+$jj['resposta']): ?>
<input type="radio" name="correta_<?=$codigo;?>" id="<?=$altcode;?>" value="<?=$altcode;?>" checked>
<label class="checkbox" for="<?=$altcode;?>"><p><i class="fa fa-check-square fa-lg"></i></p></label>
<?php else: ?>
<input type="radio" name="correta_<?=$codigo;?>" id="<?=$altcode;?>" value="<?=$altcode;?>">
<label class="checkbox" for="<?=$altcode;?>"><p><i class="fa fa-square fa-lg"></i></p></label>
<?php endif; ?>
<p class="letra">)</p>
<textarea name="alternativa_<?=$codigo;?>[]" rows="1"><?=$aa;?></textarea>
<p class="trash"><i class="fa fa-trash fa-lg"></i></p>
<input type="hidden" name="alternativas[]" value="<?=$codigo;?>:<?=$altcode;?>">
</div>
<?php endforeach; ?>
</div>
<div class="add-alternativa" data-codigo="<?=$codigo;?>"><p><i class="fa fa-plus"></i> Adicionar alternativa</p></div>
<p>Nível</p>
<select name="nivel[]">
<option value="1"<?=+$jj['nivel']===1?" selected":NULL;?>>1 - Amarelo</option>	
<option value="2"<?=+$jj['nivel']===2?" selected":NULL;?>>2 - Azul</option>
<option value="3"<?=+$jj['nivel']===3?" selected":NULL;?>>3 - Verde</option>
<input type="hidden" name="codigo[]" value="<?=$codigo;?>">
</select>
</div>
<?php endforeach; ?>
<script>$("textarea").trigger("keyup");</script>