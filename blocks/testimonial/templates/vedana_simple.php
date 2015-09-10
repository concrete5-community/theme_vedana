<?php  defined('C5_EXECUTE') or die("Access Denied.");
if ($fID) :
    $f = \File::getByID($fID);
    if (is_object($f)) :
        $img = $f->getVersion()->getRelativePath();
    endif;
endif;
?>
<div class="ved-list-block testimonial">
    <figure>
    <?php if ($image) : echo $image; endif ?>
        <figcaption>
            <h6 class="title"><?php echo $name?></h6>
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
        </figcaption>
    </figure>
</div>
