<?php
const MDFY_A = array("ALTCOD",'NUMBER10');
include "../../ogrel/functions.php";
my_session();

if($_SESSION['user']!=='kevin') die;

$codigo = addslashes($_POST['codigo']);
$altcode = mdfy(microtime(true).mt_rand(0,999999),MDFY_A,32);
?>
<div class="alternativa">
<input type="radio" name="correta_<?=$codigo;?>" id="<?=$altcode;?>" value="<?=$altcode;?>">
<label class="checkbox" for="<?=$altcode;?>"><p><i class="fa fa-square fa-lg"></i></p></label>
<p class="letra">)</p>
<textarea name="alternativa_<?=$codigo;?>[]" rows="1"></textarea>
<p class="trash"><i class="fa fa-trash fa-lg"></i></p>
<input type="hidden" name="alternativas[]" value="<?=$codigo;?>:<?=$altcode;?>">
</div>