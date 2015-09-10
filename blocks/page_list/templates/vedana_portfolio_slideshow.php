<?php
defined('C5_EXECUTE') or die("Access Denied.");

// Some settings for this template :

	$topicAttributeKeyHandle = "project_topics";
	$tagAttributeHandle = "tags";

// Some internal variables

	$rssUrl = $showRss ? $controller->getRssUrl($b) : '';
	$th = Loader::helper('text');
	$ih = Loader::helper('image');
	$dh = Core::make('helper/date');
	// Si l'utilisateur demande un detail de texte, on ne colle pas les image ensemble
	$display_info = $includeDate || $includeName || $includeDescription;
	$type = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('tiny');

	if(is_array($pages) && count($pages)) :

?><div class="ccm-block-page-list">
	<?php if ($pageListTitle): ?><div class="page-list-header"><h3><?php echo $pageListTitle?></h3></div><?php endif ?>
	<div class="grid-gallery g-gallery grid-image"><!-- This page list can be used Only Once by page -->
		<section class="grid-wrap ved-list-block">
			<ul class="grid <?php if(!$display_info) echo 'container-glued-3' ?>">
				<li class="grid-sizer"></li><!-- for Masonry column width -->

				<?php foreach ($pages as $key => $page):

					$pair = $key % 2 == 1 ? 'pair' : 'impair';
					$title = $th->entities($page->getCollectionName());
					$url = $nh->getLinkToCollection($page);
			        $date = $dh->formatDate($page->getCollectionDatePublic());

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

			  ?><li class="<?php echo $pair ?> detect item">
					<figure>
						<!-- <a href="<?php echo $url ?>" target="<?php echo $target ?>"></a> -->
						<?php if ($thumbnailUrl): ?>
							<img src="<?php echo $thumbnailUrl ?>" alt="<?php echo $title ?>">
						<?php endif ?>
						<figcaption>
							<?php if($includeDate): ?><h6 class="date"><?php echo $date ?></h6><?php endif ?>
							<?php if (is_array($topics)): ?><p><i><small><?php foreach ($topics as $key => $topic) : ?><?php echo $topic->getTreeNodeDisplayName() ?><?php endforeach ?></small></i></p><?php endif ?>			
							<?php if ($includeName): ?><?php if ($useButtonForLink) : ?><h6 class="title"><?php echo $title ?></h6><?php else : ?><a href="<?php echo $url?>" target="<?php echo $target ?>"><h6 class="title"><?php echo $title ?></h6></a><?php endif ?><hr><?php endif ?>
							<?php if ($includeDescription): ?><p><?php echo $description ?></p><?php endif ?>
                			<?php if ($useButtonForLink): ?><a href="<?php echo $url?>" class="btn btn-primary pull-right"><?php echo $buttonLinkText?></a><?php endif; ?>							
							
						</figcaption>
					</figure>
				</li><?php

				## Now we fill the slideshow structure
				
				ob_start();
				?><li>
					<figure>
						<?php if(!$display_info) : ?><a href="<?php echo $url ?>" target="<?php echo $target ?>"><?php endif ?>
						<?php if ($fullImageUrl) : ?><img src="<?php echo $fullImageUrl ?>"><?php endif ?>
						<?php if(!$display_info) : ?></a><?php endif ?>
						<figcaption>
							<?php if ($includeName): ?><?php if ($useButtonForLink) : ?><h4 class="title"><?php echo $title ?></h4><?php else : ?><a href="<?php echo $url?>" target="<?php echo $target ?>"><h4 class="title"><?php echo $title ?></h4></a><?php endif ?><hr><?php endif ?>
							<?php if ($includeDescription): ?><p><?php echo $description ?></p><?php endif ?>
							<?php if($display_info) : ?><a href="<?php echo $url ?>" class="btn btn-default"><?php echo  $buttonLinkText ?  $buttonLinkText : t('Read more') ?></a><?php endif ?>
							<?php if (is_array($topics)): ?><p><i><small><?php foreach ($topics as $key => $topic) : ?><?php echo $topic->getTreeNodeDisplayName() ?><?php endforeach ?></small></i></p><?php endif ?>			
						</figcaption>
					</figure>
				</li><?php $slideshow_items[] = ob_get_clean();  ?>


	<?php endforeach; 


		?></ul>
		</section><!-- // grid-wrap -->
		<section class="slideshow">
			<ul><?php 
			foreach ($slideshow_items as $key => $item) :
				echo $item;
			endforeach;
		?></ul>
			<nav>
				<span class="fa fa-arrow-circle-o-left nav-prev"></span>
				<span class="fa fa-arrow-circle-o-right nav-next"></span>
				<span class="fa fa-times nav-close"></span>
			</nav>
			<div class="info-keys icon">Navigate with arrow keys</div>
		</section><!-- // slideshow -->
	</div><!-- // grid-gallery -->

    <?php else: ?>
        <div class="ccm-block-page-list-no-pages"><?php echo $noResultsMessage?></div>
    <?php endif;?>

	<?php if ($showRss): ?>
		<div class="ccm-block-page-list-rss-icon">
			<a href="<?php echo $rssUrl ?>" target="_blank"><img src="<?php echo $rssIconSrc ?>" width="14" height="14" alt="<?php echo t('RSS Icon') ?>" title="<?php echo t('RSS Feed') ?>" /></a>
		</div>
		<link href="<?php echo BASE_URL.$rssUrl ?>" rel="alternate" type="application/rss+xml" title="<?php echo $rssTitle ?>" />
	<?php endif ?>
 
</div><!-- end .ccm-block-page-list -->


<?php if ($showPagination): ?>
    <?php echo $pagination;?>
<?php endif ?>