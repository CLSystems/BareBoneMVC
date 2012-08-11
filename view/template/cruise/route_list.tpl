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
			  
              <td class="left"><?php if ($sort == 'r.route_title') { ?>
                <a href="<?php echo $sort_route; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_route; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_route; ?>"><?php echo $column_route; ?></a>
                <?php } ?></td>
			  
              <td class="left"><?php if ($sort == 's.ship_name') { ?>
                <a href="<?php echo $sort_ship; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ship; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_ship; ?>"><?php echo $column_ship; ?></a>
                <?php } ?></td>
			
              <td class="left"><?php if ($sort == 't.port_departure') { ?>
                <a href="<?php echo $sort_port_departure; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_port_departure; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_port_departure; ?>"><?php echo $column_port_departure; ?></a>
                <?php } ?></td>
			  
              <td class="left"><?php if ($sort == 't.port_arrival') { ?>
                <a href="<?php echo $sort_port_arrival; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_port_arrival; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_port_arrival; ?>"><?php echo $column_port_arrival; ?></a>
                <?php } ?></td>
				
              <td><?php echo $column_transfers; ?></td>
				
              <td><?php echo $column_handling; ?></td>

              <td><?php echo $column_harbours; ?></td>
				
              <td><?php echo $column_tax_harbours; ?></td>

              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>

              <td><input name="filter_route" value="<?php echo $filter_route; ?>" /></td>
				
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

              <td><input name="filter_port_departure" value="<?php echo $filter_port_departure; ?>" size="4" /></td>

              <td><input name="filter_port_arrival" value="<?php echo $filter_port_arrival; ?>" size="4" /></td>
				
              <td></td>
				
              <td></td>

              <td></td>
				
              <td></td>

              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($routes) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($routes as $r) { ?>
            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">
			
              <td style="text-align: center;"><?php if ($r['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $r['route_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $r['route_id']; ?>" />
                <?php } ?></td>
				
              <td class="left"><?php echo $r['route_title']; ?></td>

              <td class="left"><?php echo $r['ship_name']; ?></td>
				
              <td class="left"><?php echo $r['port_departure']; ?></td>
				
              <td class="left"><?php echo $r['port_arrival']; ?></td>
				
              <td class="left"><?php echo $r['transfers']; ?></td>
				
              <td class="left"><?php echo $r['handling']; ?></td>
			  
              <td class="left"><?php echo $r['harbours']; ?></td>
				
              <td class="left"><?php echo $r['tax_harbours']; ?></td>
			  
              <td class="right"><?php foreach ($r['action'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><img src="view/image/pencil.png" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" /><!-- [ <?php echo $action['text']; ?> ]--></a>
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=maintenance/route&token=<?php echo $token; ?>';

	var filter_route = $('input[name=\'filter_route\']').attr('value');
	
	if (filter_route) {
		url += '&filter_route=' + encodeURIComponent(filter_route);
	}	

	var filter_ship = $('select[name=\'filter_ship\']').attr('value');
	
	if (filter_ship != '*') {
		url += '&filter_ship=' + encodeURIComponent(filter_ship);
	}	

	var filter_port_departure = $('input[name=\'filter_port_departure\']').attr('value');
	
	if (filter_port_departure) {
		url += '&filter_port_departure=' + encodeURIComponent(filter_port_departure);
	}	

	var filter_port_arrival = $('input[name=\'filter_port_arrival\']').attr('value');
	
	if (filter_port_arrival) {
		url += '&filter_port_arrival=' + encodeURIComponent(filter_port_arrival);
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