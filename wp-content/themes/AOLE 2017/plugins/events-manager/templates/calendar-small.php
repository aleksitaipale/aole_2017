<?php 
/*
 * This file contains the HTML generated for small calendars. You can copy this file to yourthemefolder/plugins/events-manager/templates and modify it in an upgrade-safe manner.
 * 
 * There are two variables made available to you: 
 * 
 * 	$calendar - contains an array of information regarding the calendar and is used to generate the content
 *  $args - the arguments passed to EM_Calendar::output()
 * 
 * Note that leaving the class names for the previous/next links will keep the AJAX navigation working.
 */
?>
<table class="em-calendar">
	<thead>
		<tr>
			<td><a class="em-calnav em-calnav-prev" href="<?php echo esc_url($calendar['links']['previous_url']); ?>" rel="nofollow">&lt;&lt;</a></td>
			<td class="month_name" colspan="5"><?php echo esc_html(date_i18n(get_option('dbem_small_calendar_month_format'), $calendar['month_start'])); ?></td>
			<td><a class="em-calnav em-calnav-next" href="<?php echo esc_url($calendar['links']['next_url']); ?>" rel="nofollow">&gt;&gt;</a></td>
		</tr>
	</thead>
	<tbody>
		<tr class="days-names">
			<td><?php echo implode('</td><td>',$calendar['row_headers']); ?></td>
		</tr>
		<tr>
			<?php
			$cal_count = count($calendar['cells']);
			$col_count = $count = 1; //this counts collumns in the $calendar_array['cells'] array
			$col_max = count($calendar['row_headers']); //each time this collumn number is reached, we create a new collumn, the number of cells should divide evenly by the number of row_headers
			foreach($calendar['cells'] as $date => $cell_data ){
				$class = ( !empty($cell_data['events']) && count($cell_data['events']) > 0 ) ? 'eventful':'eventless';
				if(!empty($cell_data['type'])){
					$class .= "-".$cell_data['type']; 
				}
				?>
				<td class="<?php echo esc_attr($class); ?>">
					<?php if( !empty($cell_data['events']) && count($cell_data['events']) > 0 ): ?>
						<?php
						
						$eventsList = [];

						foreach ($cell_data['events'] as $event){
							$eventsList[$event->post_id]->permalink = get_permalink($event->post_id);;
							$eventsList[$event->post_id]->event = $event;
							$eventsList[$event->post_id]->facilitators = get_field("facilitators", $event->post_id);

						}

						
						?>

						<button type="button" class="button" data-events='<?php echo json_encode($eventsList, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS); ?>' data-date="<?php echo date('l jS \of F Y', $cell_data['date']); ?>">
							<?php echo esc_html(date('j',$cell_data['date'])); ?></button>
						<?php else:?>
							<?php echo esc_html(date('j',$cell_data['date'])); ?>
						<?php endif; ?>
					</td>
					<?php
				//create a new row once we reach the end of a table collumn
					$col_count= ($col_count == $col_max ) ? 1 : $col_count+1;
					echo ($col_count == 1 && $count < $cal_count) ? '</tr><tr>':'';
					$count ++; 
				}
				?>
			</tr>
		</tbody>
	</table>

<!--	https://wpshout.com/building-a-magical-golden-bridge-from-php-to-javascript-with-wp_localize_script/ -->