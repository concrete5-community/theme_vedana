<?php defined('C5_EXECUTE') or die("Access Denied.")?>

<<?php echo $tag ?>><?php echo $setenceStart ?><span id="typer-<?php echo $bID?>" class="mylab_typer"></span><span class="typer-first-sentence"><?php echo $firstSentence ?></span>	<?php echo $setenceEnd ?><<?php echo $tag ?>>


<script>
	$(document).ready(function(){
		$('#typer-<?php echo $bID?>').typer(<?php echo $comaSeparatedSentence ?>);		
	}) 
</script>