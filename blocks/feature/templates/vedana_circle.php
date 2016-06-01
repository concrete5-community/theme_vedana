<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="feature-circle feature-item ">
	<div class="icon detect">
		<i class="fa fa-<?php echo $icon?> fa-4x primary"></i>	
	</div>

    <?php if ($title) { ?>
        <h6 class="box-arrow primary full big"> <?php echo $title?></h6>
        <hr>
    <?php } ?>
    <?php if ($paragraph) { ?>
        <p><?php echo $paragraph?></p>
    <?php } ?>
</div>
