<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Attribute\Select\OptionList;
// Some settings for this template :

	$topicAttributeKeyHandle = "project_topics";
	$tagAttributeHandle = "tags";

// Some internal variables

	$rssUrl = $showRss ? $controller->getRssUrl($b) : '';
	$th = Loader::helper('text');
	$dh = Core::make('helper/date');
	$type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('tiny');
	

	if(is_array($pages) && count($pages)) :

?><div class="page-list simple-page-list blog-page-list">

    <?php if ($pageListTitle): ?>
    <div class="page-list-header">
        <h3><?php echo $pageListTitle?></h3>
    </div>
    <?php endif; ?>

	<?php foreach ($pages as $key => $page):

		$pair = $key % 2 == 1 ? 'pair' : 'impair';

		$title = $th->entities($page->getCollectionName());
		$url = $nh->getLinkToCollection($page);
        $date = date('M / d / Y',strtotime($page->getCollectionDatePublic()));
        $user = UserInfo::getByID($page->getCollectionUserID());
        $tags = $page->getAttribute('tags');

		$target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
		$target = empty($target) ? '_self' : $target;

		$description = $page->getCollectionDescription();
		$description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
		$description = $th->entities($description);	

		$topics = $page->getAttribute($topicAttributeKeyHandle);
        $options = $page->getAttribute($tagAttributeHandle);
        $options = is_object($options)  ? $options->getOptions() : array();

		if ($displayThumbnail) :
			$img_att = $page->getAttribute('thumbnail');
			if($type != NULL && is_object($img_att)) :
		    	$thumbnailUrl = $img_att->getThumbnailURL($type->getBaseVersion());
			    $fullImageUrl = $img_att->getRelativePath();
			else: 
				$thumbnailUrl = false;
			endif;	
		endif;	
		
?>
		<div class="item <?php echo $pair ?> detect clearfix">
			<?php if ($thumbnailUrl): ?>
			<a href="<?php echo $url ?>" class="thumb">
				<img src="<?php echo $thumbnailUrl ?>" alt="<?php echo $title ?>">
			</a>				
			<?php endif ?>
			<div class="info">
				<?php if ($includeName): ?><?php if ($useButtonForLink) : ?><h3><?php echo $title ?></h3><?php else : ?><a href="<?php echo $url?>" target="<?php echo $target ?>"><h3><?php echo $title ?></h3></a><?php endif ?><?php endif ?>
				<?php if ($includeDate) : ?>
				<div class="meta">
					<h6 class="secondary"><?php echo $date ?></h6>
					<span class="loud">&nbsp;&nbsp;<?php echo t('By:') ?></span>
					<span><?php echo $user->getUserDisplayName() ?></span>
					<?php if ($tags instanceof OptionList && $tags->count() > 0): ?>
					<span class="loud">&nbsp;&nbsp;<?php echo t('Tags:') ?></span>
					<?php  foreach ($tags as $tag) : ?>
						<span><?php echo $tag->getSelectAttributeOptionValue()?></span>
					<?php endforeach; endif ?>
				</div>
				<?php endif ?>
				<?php if ($includeDescription): ?><p><?php echo $description ?></p><?php endif ?>
				<?php if (is_array($topics)): ?><p class="topics"><i><small><?php foreach ($topics as $key => $topic) : ?><?php echo $topic->getTreeNodeDisplayName() ?><?php endforeach ?></small></i></p><?php endif ?>				
			</div>
			</a>
		</div>
		<hr>
	<?php endforeach; ?>

    <?php else: ?>
        <div class="ccm-block-page-list-no-pages"><?php echo $noResultsMessage?></div>
    <?php endif;?>
 

	<?php if ($showRss): ?>
		<div class="ccm-block-page-list-rss-icon">
			<a href="<?php echo $rssUrl ?>" target="_blank"><img src="<?php echo $rssIconSrc ?>" width="14" height="14" alt="<?php echo t('RSS Icon') ?>" title="<?php echo t('RSS Feed') ?>" /></a>
		</div>
		<link href="<?php echo BASE_URL.$rssUrl ?>" rel="alternate" type="application/rss+xml" title="<?php echo $rssTitle; ?>" />
	<?php endif; ?>
 
</div><!-- end .ccm-block-page-list -->


<?php if ($showPagination): ?>
    <?php echo $pagination;?>
<?php endif; ?>