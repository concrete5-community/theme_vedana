<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<?php if(count($rows) > 0) : ?>
<div class="accordion">
    <dl>    
     <?php foreach($rows as $key => $row) : ?>
        <dt><a class="accordionTitle" href="#"><?php echo $row['title'] ?></a></dt>
        <dd class="accordionItem <?php echo $key == 0 ? '' : 'accordionItemCollapsed' ?>">
            <div class="inner">
                <?php echo nl2p($row['description']) ?>
            </div>
        </dd>       
    <?php endforeach ?>
    </dl>
</div>
<?php else: ?>
<div class="ccm-faq-block-links">
    <p><?php echo t('No Faq Entries Entered.'); ?></p>
</div>    
<?php endif ?>

<?php 
function nl2p($string)
{
    $paragraphs = '';

    foreach (explode("\n", $string) as $line) {
        if (trim($line)) {
            $paragraphs .= '<p>' . $line . '</p>';
        }
    }

    return $paragraphs;
} ?>

