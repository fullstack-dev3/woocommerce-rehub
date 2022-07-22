<?php
/*
  Name: Image with description
 */

?>
<?php if (isset($title) && $title): ?>
    <h3 class="cegg-shortcode-title"><?php echo esc_html($title); ?></h3>
<?php endif; ?>
<?php foreach ($items as $item): ?>
	<?php $tagss = ($item['extra']['tags']) ? $item['extra']['tags'] : $item['keyword'];?>
    <div class="text-center"><img src="<?php echo esc_url($item['img']); ?>" alt="<?php echo esc_attr($tagss); ?>" class="img-thumbnail-block" /></div>
    <div class="img-descr text-center mb10">
    <p class="font80 mb10"><?php printf(__('Photo %s on Flickr', 'rehub-theme'), '<a href="' . $item['url'] . '" target="_blank" rel="nofollow sponsored">' . $item['extra']['author'] . '</a>'); ?></p>
    <h4><?php echo esc_html($item['title']); ?></h4>
    <p><?php echo esc_attr($item['description']); ?></p>
    <div class="clearfix"></div>   
    </div>    
<?php endforeach; ?>