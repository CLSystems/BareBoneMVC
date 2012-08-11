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
			  
              <td class="left"><?php if ($sort == 's.ship_name') { ?>
                <a href="<?php echo $sort_ship; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ship; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_ship; ?>"><?php echo $column_ship; ?></a>
                <?php } ?></td>
			  
              <td class="left"><?php if ($sort == 'r.route_title') { ?>
                <a href="<?php echo $sort_route; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_route; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_route; ?>"><?php echo $column_route; ?></a>
                <?php } ?></td>
				
				<td><?php echo $column_date_departure; ?></td>
				
				<td><?php echo $column_date_arrival; ?></td>
				
              <td class="left"><?php if ($sort == 'ct.cabin_type_name') { ?>
                <a href="<?php echo $sort_cabin_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_cabin_type; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_cabin_type; ?>"><?php echo $column_cabin_type; ?></a>
                <?php } ?></td>
			  
              <td class="left"><?php if ($sort == 'cc.cabin_category_name') { ?>
                <a href="<?php echo $sort_cabin_category; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_cabin_category; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_cabin_category; ?>"><?php echo $column_cabin_category; ?></a>
                <?php } ?></td>
			  
              <td class="right"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
                <?php } ?></td>
				
				<td class="right"><?php echo $column_own_commission; ?></td>
				
				<td class="right"><?php echo $column_agent_commission; ?></td>
				
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
                  <?php foreach ($routes as $r) { ?>
					  <?php if ($r['route_id'] == $filter_route) { ?>
						  <option value="<?php echo $r['route_id']; ?>" selected="selected"><?php echo $r['route_title']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $r['route_id']; ?>"><?php echo $r['route_title']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
				
				<td> </td>
				
				<td> </td>
				
              <td><select name="filter_cabin_type">
                  <option value="*" selected="selected"> </option>
                  <?php foreach ($cabin_types as $cabin_type) { ?>
					  <?php if ($cabin_type['cabin_type_id'] == $filter_cabin_type) { ?>
						  <option value="<?php echo $cabin_type['cabin_type_id']; ?>" selected="selected"><?php echo $cabin_type['cabin_type_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $cabin_type['cabin_type_id']; ?>"><?php echo $cabin_type['cabin_type_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select>			  
			  </td>
			  
			  <td><select name="filter_cabin_category">
                  <option value="*" selected="selected"> </option>
                  <?php foreach ($cabin_categories as $cabin_category) { ?>
					  <?php if ($cabin_category['cabin_category_id'] == $filter_cabin_category) { ?>
						  <option value="<?php echo $cabin_category['cabin_category_id']; ?>" selected="selected"><?php echo $cabin_category['cabin_category_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $cabin_category['cabin_category_id']; ?>"><?php echo $cabin_category['cabin_category_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select>
				</td>

              <td class="right"><input name="filter_price" value="<?php echo $filter_price; ?>" size="4" /></td>
				
				<td> </td>
				
				<td> </td>
				
              <td class="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($prices) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($prices as $price) { ?>
            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">
			
              <td style="text-align: center;"><?php if ($price['selected']) { ?>
					<input type="checkbox" name="selected[]" value="<?php echo $price['price_id']; ?>" checked="checked" />
                <?php } else { ?>
					<input type="checkbox" name="selected[]" value="<?php echo $price['price_id']; ?>" />
                <?php } ?></td>
				
              <td class="left"><?php echo $price['ship_name']; ?></td>
				
              <td class="left"><?php echo $price['route_title']; ?></td>
				
              <td class="left"><?php echo $price['date_departure']; ?></td>
				
              <td class="left"><?php echo $price['date_arrival']; ?></td>
				
              <td class="left"><?php echo $price['cabin_type']; ?></td>
				
              <td class="left"><?php echo $price['cabin_category']; ?></td>
				
              <td class="right"><?php ($price['price']<1) ? print $text_on_request : print $price['price']; ?></td>
				
              <td class="right"><?php echo $price['own_commission']; ?></td>
				
              <td class="right"><?php echo $price['agent_commission']; ?></td>
				
              <td class="right"><?php foreach ($price['action'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><img src="view/image/pencil.png" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" /><!-- [ <?php echo $action['text']; ?> ]--></a>
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="11"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
	  
      <div class="pagination"><?php echo $pagination; ?></div>
	  
    </div>
  </div>
</div>
<script type="text/javascript"><!-- 
function filter() {
	url = 'index.php?route=maintenance/price&token=<?php echo $token; ?>';

	var filter_ship = $('select[name=\'filter_ship\']').attr('value');
	
	if (filter_ship != '*') {
		url += '&filter_ship=' + encodeURIComponent(filter_ship);
	}	

	var filter_route = $('select[name=\'filter_route\']').attr('value');
	
	if (filter_route != '*') {
		url += '&filter_route=' + encodeURIComponent(filter_route);
	}	

	var filter_cabin_type = $('select[name=\'filter_cabin_type\']').attr('value');
	
	if (filter_cabin_type != '*') {
		url += '&filter_cabin_type=' + encodeURIComponent(filter_cabin_type);
	}	

	var filter_cabin_category = $('select[name=\'filter_cabin_category\']').attr('value');
	
	if (filter_cabin_category != '*') {
		url += '&filter_cabin_category=' + encodeURIComponent(filter_cabin_category);
	}	

	var filter_price = $('input[name=\'filter_price\']').attr('value');
	
	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
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