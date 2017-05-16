<?php
$fImage = $instance['image-first'];
$sImage = $instance['image-second'];
?>

<div class="gw-twentytwenty-wrapper">
	<h2><?php echo $instance['title']; ?></h2>
	<div class="gw-twentytwenty-image-container">
		<?php echo wp_get_attachment_image($fImage, 'full'); ?>
		<?php echo wp_get_attachment_image($sImage, 'full'); ?>
	</div>
</div>