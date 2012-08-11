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
              <td class="left"><?php if ($sort == 'ct.cabin_type_name') { ?>
                <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                <?php } ?></td>
				
              <td class="left"><?php if ($sort == 'cc.cabin_category_name') { ?>
                <a href="<?php echo $sort_category; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_category; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_category; ?>"><?php echo $column_category; ?></a>
                <?php } ?></td>
				
              <td class="left"><?php if ($sort == 's.ship_name') { ?>
                <a href="<?php echo $sort_ship; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ship; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_ship; ?>"><?php echo $column_ship; ?></a>
                <?php } ?></td>
				
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td><select name="filter_title">
                  <option value="*" selected="selected"> </option>
                  <?php foreach ($cabintypes as $cabintype) { ?>
					  <?php if ($cabintype['cabin_type_id'] == $filter_title) { ?>
						  <option value="<?php echo $cabintype['cabin_type_id']; ?>" selected="selected"><?php echo $cabintype['cabin_type_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $cabintype['cabin_type_id']; ?>"><?php echo $cabintype['cabin_type_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
              <td><select name="filter_category">
                  <option value="*" selected="selected"> </option>
                  <?php foreach ($categories as $category) { ?>
					  <?php if ($category['cabin_category_id'] == $filter_category) { ?>
						  <option value="<?php echo $category['cabin_category_id']; ?>" selected="selected"><?php echo $category['cabin_category_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $category['cabin_category_id']; ?>"><?php echo $category['cabin_category_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
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
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($cabins) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($cabins as $cabin) { ?>
            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">
              <td style="text-align: center;"><?php if ($cabin['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $cabin['cabin_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $cabin['cabin_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $cabin['title']; ?></td>
              <td class="left"><?php echo $cabin['category']; ?></td>
              <td class="left"><?php echo $cabin['ship']; ?></td>
			  
              <td class="right"><?php foreach ($cabin['action'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><img src="view/image/pencil.png" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" /><!-- [ <?php echo $action['text']; ?> ]--></a>
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="5"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=maintenance/cabin&token=<?php echo $token; ?>';

	var filter_title = $('select[name=\'filter_title\']').attr('value');
	
	if (filter_title != '*') {
		url += '&filter_title=' + encodeURIComponent(filter_title);
	}	

	var filter_category = $('select[name=\'filter_category\']').attr('value');
	
	if (filter_category != '*') {
		url += '&filter_category=' + encodeURIComponent(filter_category);
	}	

	var filter_ship = $('select[name=\'filter_ship\']').attr('value');
	
	if (filter_ship != '*') {
		url += '&filter_ship=' + encodeURIComponent(filter_ship);
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