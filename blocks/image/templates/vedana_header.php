<?php defined('C5_EXECUTE') or die("Access Denied.");

if (is_object($f)) :
	$fv = $f->getVersion();
    $path = $fv->getRelativePath();
	$title = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>',$fv->getTitle());
	$desc = $fv->getDescription();
endif;
$height = $this->controller->maxHeight;
?>
<div class="ccm-intro-block" style=" <?php if ($path) : ?>background-image:url(<?php echo $path ?>)<?php endif?>;<?php if ($height) : ?>height:<?php echo $height ?>px<?php endif ?>">
	<div class="container">
		<?php if($title) : ?><h2><?php echo $title ?></h2><?php endif ?>
		<?php if($desc) : ?><p><?php echo $desc ?></p><?php endif ?>
		
	</div>
</div>