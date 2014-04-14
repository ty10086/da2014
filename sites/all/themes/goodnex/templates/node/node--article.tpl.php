<?php

/**
 * @file node.tpl.php
 * Goodnex's template to display a node.
 */
 
$uid = user_load($node->uid);

if (module_exists('profile2')) {  
  $profile = profile2_load_by_user($uid, 'main');
} 
$image_slide = "";

if ($items = field_get_items('node', $node, 'field_image')) {
  if (count($items) == 1) {
    $image_slide = 'false';
  }
  elseif (count($items) > 1) {
    $image_slide = 'true';
  }
}

$img_count = 0;
$counter = count($items);

?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($teaser): ?>

	  <?php if ( ($image_slide == 'true') ): ?>
	    <div class="image-post-slider">
			  <ul>
			    <?php while ($img_count < $counter) { ?>
			      <li>
						  <div class="preloader">
								<a class="bwWrapper single-image link-icon" href="<?php print $node_url; ?>">
									<img src="<?php echo file_create_url($node->field_image['und'][$img_count]['uri']); ?>" alt="" >
								</a>						
							</div>
			      </li>
				  <?php $img_count++; } ?>		
			  </ul>
	    </div>    
		<?php endif; ?>
				
		<?php if ($image_slide == 'false'): ?>
		  <div class="preloader">
				<a class="bwWrapper single-image link-icon" href="<?php print $node_url; ?>">
					<img src="<?php echo file_create_url($node->field_image['und'][0]['uri']); ?>" alt="" >
				</a>						
			</div>
		<?php endif; ?>
	
	<?php endif; ?>
	
	<?php if (!$teaser): ?>

	  <?php if ( ($image_slide == 'true') ): ?>
	    <div class="image-post-slider">
			  <ul>
			    <?php while ($img_count < $counter) { ?>
			      <li>
						  <div class="preloader">
								<a class="bwWrapper single-image plus-icon" href="<?php echo file_create_url($node->field_image['und'][$img_count]['uri']); ?>" rel="gallery">
									<img src="<?php echo file_create_url($node->field_image['und'][$img_count]['uri']); ?>" alt="" >
								</a>						
							</div>
			      </li>
				  <?php $img_count++; } ?>		
			  </ul>
	    </div>    
		<?php endif; ?>
				
		<?php if ($image_slide == 'false'): ?>
		  <div class="preloader">
				<a class="bwWrapper single-image plus-icon" href="<?php echo file_create_url($node->field_image['und'][0]['uri']); ?>">
					<img src="<?php echo file_create_url($node->field_image['und'][0]['uri']); ?>" alt="" >
				</a>						
			</div>
		<?php endif; ?>
	
	<?php endif; ?>
	
	<?php if (render($content['field_before_title'])) : ?>
	  
	    <?php print render($content['field_before_title']); ?>

	<?php endif; ?>
		
  <div class="entry">
  <?php print render($title_prefix); ?>
  
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
 
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="entry-meta">
			<span class="date"><?php print format_date($node->created, 'custom', 'M d, Y'); ?></span>
			<span class="author"><?php echo t('By'); ?> <?php print $name; ?></span>
			<?php if (render($content['field_tags'])): ?>  
			  <span class="tag"><?php print render($content['field_tags']); ?></span>
			<?php endif; ?>  
			<span class="comments"><a href="<?php print $node_url;?>/#comments"><?php print $comment_count; ?> comment<?php if ($comment_count != "1" ) { echo "s"; } ?></a></span>
		</div><!--/ .entry-meta-->
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_image']);
      hide($content['field_widget_image']);
      print render($content);
    ?>
  </div>

  <?php if($teaser): ?>
	  	<a class="button default small" href="<?php print $node_url;?>">read more</a>
	<?php endif;?>
	
	<?php if(!$teaser): ?>
	<div class="author-about">

		<div class="author-thumb">

			<div class="bordered">
				<div class="avatar">
				  <?php print $user_picture; ?>
				</div>
			</div><!--/ .bordered-->

		</div><!--/ .author-thumb-->

		<div class="author-entry">

			<h5><?php echo t('About the Author'); ?></h5>

			<p>
				<?php if (isset($profile->field_bio['und'][0]['value'])): ?>
          <?php print ($profile->field_bio['und'][0]['value']); ?>
        <?php endif; ?>			</p>

		</div><!--/ .author-entry-->

	</div><!--/ .about-author-->
	<?php endif;?>
  </div>

  <?php print render($content['comments']); ?>
</article>