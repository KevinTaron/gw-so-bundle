<?php
$date = '';
$alignment = '';
if(!empty($instance['date'])) $date = $instance['date'] ;
if(!empty($instance['alignment'])) $alignment = $instance['alignment'] ;
?>
<div class="gw-countdown-wrapper">
	<div class="gw-countdown-content <?php echo $alignment; ?>">
		<div class="gw-countdown-clock" data-countdown="<?php echo $date; ?>"></div>
	</div>
</div>