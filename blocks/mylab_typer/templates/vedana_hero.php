<?php defined('C5_EXECUTE') or die("Access Denied.")?>

<div style="text-align:center">
	<<?php echo $tag ?> class="hero"><?php echo $setenceStart ?><span id="typer-<?php echo $bID?>" class="mylab_typer"></span><span class="typer-first-sentence"><?php echo $firstSentence ?></span> <?php echo $setenceEnd ?><<?php echo $tag ?>>
</div>
<script>
	$(document).ready(function(){
		$('#typer-<?php echo $bID?>').typer(<?php echo $comaSeparatedSentence ?>);
	}) 
</script>