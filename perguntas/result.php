<?php
if(basename($_SERVER['PHP_SELF'])!=='index.php') die;
$correta = &$json['resposta'];
$marcada = $_SESSION['perguntas'][$n][$p-1];
?>
<div id="alternativas">
<?php foreach($alternativas as $i => $aa): 
if($i===$marcada && $i===$correta) $class = "correta";
elseif($i===$marcada && $i!==$correta) $class = "errada";
elseif($i!==$marcada && $i===$correta) $class = "gabarito";
elseif($i!==$marcada && $i!==$correta) $class = "normal";
?>
<div class="alternativa <?=$class;?>">
<?php if($class==='correta'): ?>
<i class="fa fa-check fa-lg"></i>
<?php elseif($class==='errada'): ?>
<i class="fa fa-times fa-lg"></i>
<?php endif; ?>
<p><?=$aa;?></p>
</div>
<?php endforeach; ?>
</div>
<a href="../"><p><i class="fa fa-arrow-left"></i> Voltar</p></a>
</body>
</html>
