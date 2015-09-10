<?php  defined('C5_EXECUTE') or die("Access Denied.");
if ($fID) :
    $f = \File::getByID($fID);
    if (is_object($f)) :
        $img = $f->getVersion()->getRelativePath();
    endif;
endif;
?>
<div class="ch-grid flex-box">
    <div class="ch-grid-inner content">
        <div class="ch-item ch-bg-img content" <?php if ($img): ?>style="background-image:url(<?php echo $img?>)"<?php endif?>>              
            <div class="ch-info-wrap">
                <div class="ch-info">
                    <div class="ch-info-front ch-bg-img" <?php if ($img): ?>style="background-image:url(<?php echo $img?>)"<?php endif?>></div>
                    <div class="ch-info-back">
                        <h6><?php echo $name?></h6>
                        <?php if ($position && $company && $companyURL): ?>
                            <?php echo t('<p class="position">%s</p><p class="company"><a href="%s">%s</a></p>', $position, $companyURL, $company)?>
                        <?php endif; ?>

                        <?php if ($position && $company && !$companyURL): ?>
                            <?php echo t('<p class="position">%s</p><p class="company">%s</p>', $position, $company)?>
                        <?php endif; ?>

                        <?php if ($position && !$company && !$companyURL): ?>
                            <p class="position"><?php echo $position?></p>
                        <?php endif; ?>
    
                        <?php if ($paragraph) : ?>
                            <hr class="middle">
                            <p class="text"><?php echo $paragraph?></p>
                        <?php endif ?>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
