<?php defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Block\View\BlockView;

$c = Page::getCurrentPage();
$cp = new Permissions($c);
if ($cp->canViewPageVersions()) {
	$stack = Stack::getByID($stID);	
} else {
	$stack = Stack::getByID($stID, 'ACTIVE');
}
if (is_object($stack)) { 
	$ax = Area::get($stack, STACKS_AREA_NAME);
	$axp = new Permissions($ax);
	if ($axp->canRead()) {
        $ax->disableControls();
		$blocks = $ax->getAreaBlocksArray();
	}
}
if (is_array($blocks) && count($blocks)): ?>
<div class="accordion">
	 <dl>
	<?php foreach ($blocks as $key => $block) :
			$bv = new BlockView($block); ?>
       	<dt class="title <?php echo $key === 0 ? 'active' : '' ?>">
            <a class="accordionTitle" href=""><?php echo $block->getBlockName() ? $block->getBlockName() : t('Title ') . $key ?></a>
        </dt>		
        <dd class="accordionItem <?php  echo $key == 0 ? '' : 'accordionItemCollapsed' ?>">
			<div class="inner"><?php echo $bv->render('view') ?></div>
        </dd>				
	<?php endforeach ?>
	</dl>
</div>
<?php endif ?>