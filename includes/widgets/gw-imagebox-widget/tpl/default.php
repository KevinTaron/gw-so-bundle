<?php
$url = null; 
if(!empty($instance['controls']['url'])) $url = $instance['controls']['url'];

$myimage = $instance['bgimage']['image'];
$mysize = $instance['bgimage']['size'];
$attr['srcset'] = wp_get_attachment_image_srcset( $myimage, $mysize );
$bgimage = wp_get_attachment_image_src($myimage, $mysize);

$divimagecontent = '<div class="gw-contentbox-image" ';
$divimagecontent .= 'style="background-image: url(\'' . $bgimage[0] .'\'); "';
$divimagecontent .= '></div>';


?>

<div class="gw-contentbox-wrapper">
	
	<div class="gw-contentbox-image-wrapper">
		<?php if($url != null): ?>
			<a href="">
				<?php echo $divimagecontent; ?>
			</a>
		<?php else: ?>
			<?php echo $divimagecontent; ?>
		<?php endif; ?>
	</div>

	<div class="gw-contentbox-content <?php echo $instance['contentbox']['boxposition'] ?>">
		<div class="gw-contentbox-inner">
			<?php echo $instance['contentbox']['text'] ?>
		</div>
	</div>
</div>