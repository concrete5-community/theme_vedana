<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="feature-inline clearfix">
    <?php if ($title) { ?>
    	<div class="wrap-left" <?php if (!$paragraph) : ?>style="width:100%" <?php endif ?>>
		    <div class="icon"><i class="fa fa-<?php echo $icon?>"></i></div>
		    <h5><?php echo $title?></h5>    		
    	</div>
     <?php } ?>
    <?php if ($paragraph) { ?>
        <div class="wrap-right">
        	<p><?php echo $paragraph?></p>
        </div>
    <?php } ?>
</div>