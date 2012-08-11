<?php echo $header; ?>

<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/company.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
	  	<a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a>
		<a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a>
		<a onclick="$('#form').attr('action', '<?php echo $delete; ?>'); $('#form').submit();" class="button"><?php echo $button_delete; ?></a>
	  </div>
    </div>
    <div class="content">
	
      <div class="pagination"><?php echo $pagination; ?></div>
	
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			  
              <td class="left"><?php echo $column_ship; ?></td>
						  
              <td class="left"><?php if ($sort == 'r.route_title') { ?>
                <a href="<?php echo $sort_route; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_route; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_route; ?>"><?php echo $column_route; ?></a>
                <?php } ?></td>
						  
              <td class="left"><?php if ($sort == 'c.date_departure') { ?>
                <a href="<?php echo $sort_date_departure; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_departure; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_departure; ?>"><?php echo $column_date_departure; ?></a>
                <?php } ?></td>
			  
              <td class="left"><?php if ($sort == 'c.date_arrival') { ?>
                <a href="<?php echo $sort_date_arrival; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_arrival; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date_arrival; ?>"><?php echo $column_date_arrival; ?></a>
                <?php } ?></td>
			  
              <td class="left"><?php echo $column_flight; ?></td>
			  
              <td class="left"><?php echo $column_taxes; ?></td>
			  
              <td class="left"><?php echo $column_hotel; ?></td>
				
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
			
              <td></td>
			  
              <td><select name="filter_ship">
                  <option value="*" selected="selected"> </option>
                  <?php foreach ($ships as $ship) { ?>
					  <?php if ($ship['ship_id'] == $filter_ship) { ?>
						  <option value="<?php echo $ship['ship_id']; ?>" selected="selected"><?php echo $ship['ship_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $ship['ship_id']; ?>"><?php echo $ship['ship_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>

              <td><select name="filter_route">
                  <option value="*" selected="selected"> </option>
                  <?php foreach ($routes as $route) { ?>
					  <?php if ($route['route_id'] == $filter_route) { ?>
						  <option value="<?php echo $route['route_id']; ?>" selected="selected"><?php echo $route['route_title']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $route['route_id']; ?>"><?php echo $route['route_title']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
				

              <td><input name="filter_date_departure" value="<?php echo $filter_date_departure; ?>" class="date" size="8"></td>

              <td><input name="filter_date_arrival" value="<?php echo $filter_date_arrival; ?>" class="date" size="8"></td>
			  
              <td></td>
			  
              <td></td>
			  
              <td></td>
			  
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($cruises) { ?>
				<?php $class = 'odd'; ?>
				<?php foreach ($cruises as $cruise) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<tr class="<?php echo $class; ?>">
					
					  <td style="text-align: center;"><?php if ($cruise['selected']) { ?>
						<input type="checkbox" name="selected[]" value="<?php echo $cruise['cruise_id']; ?>" checked="checked" />
						<?php } else { ?>
						<input type="checkbox" name="selected[]" value="<?php echo $cruise['cruise_id']; ?>" />
						<?php } ?></td>
						
					  <td class="left"><?php echo $cruise['ship_name']; ?></td>
						
					  <td class="left"><?php echo $cruise['route_name']; ?></td>
						
					  <td class="left"><?php echo $cruise['date_departure']; ?></td>
						
					  <td class="left"><?php echo $cruise['date_arrival']; ?></td>
						
					  <td class="left"><?php echo $cruise['flight']; ?></td>
						
					  <td class="left"><?php echo $cruise['taxes']; ?></td>
						
					  <td class="left"><?php echo $cruise['hotel']; ?></td>
					  
					  <td class="right"><?php foreach ($cruise['action'] as $action) { ?>
						<a href="<?php echo $action['href']; ?>"><img src="view/image/pencil.png" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" /><!-- [ <?php echo $action['text']; ?> ]--></a>
						<?php } ?></td>
					</tr>
				<?php } ?>
            <?php } else { ?>
				<tr>
				  <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
				</tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
	  
      <div class="pagination"><?php echo $pagination; ?></div>
	  
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'dd-mm-yy'});
//--></script>
<script type="text/javascript"><!-- 
function filter() {
	url = 'index.php?route=maintenance/cruise&token=<?php echo $token; ?>';

	var filter_ship = $('select[name=\'filter_ship\']').attr('value');
	
	if (filter_ship != '*') {
		url += '&filter_ship=' + encodeURIComponent(filter_ship);
	}	

	var filter_route = $('select[name=\'filter_route\']').attr('value');
	
	if (filter_route != '*') {
		url += '&filter_route=' + encodeURIComponent(filter_route);
	}	

	var filter_date_departure = $('input[name=\'filter_date_departure\']').attr('value');
	
	if (filter_date_departure) {
		url += '&filter_date_departure=' + encodeURIComponent(filter_date_departure);
	}	

	var filter_date_arrival = $('input[name=\'filter_date_arrival\']').attr('value');
	
	if (filter_date_arrival) {
		url += '&filter_date_arrival=' + encodeURIComponent(filter_date_arrival);
	}	
	
	// alert('Going to URL '+url);
	$('#form').attr('action', url);
	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<?php echo $footer; ?>