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
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/company.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
	  	<a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
		<a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
		</div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-descriptions"><?php echo $tab_descriptions; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_route; ?></td>
              <td colspan="5"><select name="route_id">
                  <option value="0" selected="selected"><?php echo $text_select; ?></option>
                  <?php foreach ($routes as $route) { ?>
					  <?php if ($route['route_id'] == $route_id) { ?>
						  <option value="<?php echo $route['route_id']; ?>" selected="selected"><?php echo $route['ship_name']; ?> | <?php echo $route['route_title']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $route['route_id']; ?>"><?php echo $route['ship_name']; ?> | <?php echo $route['route_title']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
				
            </tr>
		  	
            <tr>
				
              <td><span class="required">*</span> <?php echo $entry_date_departure; ?></td>
              <td><input name="date_departure" value="<?php echo $date_departure; ?>" class="date" size="8" />
			  <?php if ($error_date_departure) { ?>
                <span class="error"><?php echo $error_date_departure; ?></span>
                <?php } ?></td>

              <td><span class="required">*</span> <?php echo $entry_time_departure; ?></td>
              <td><input name="time_departure" value="<?php echo $time_departure; ?>" size="4" class="time" />
			  <?php if ($error_time_departure) { ?>
                <span class="error"><?php echo $error_time_departure; ?></span>
                <?php } ?></td>
				
				<td> </td>
				<td> </td>
				
            </tr>
		  	
            <tr>
				
              <td><span class="required">*</span> <?php echo $entry_date_arrival; ?></td>
              <td><input name="date_arrival" value="<?php echo $date_arrival; ?>" class="date" size="8" />
			  <?php if ($error_date_arrival) { ?>
                <span class="error"><?php echo $error_date_arrival; ?></span>
                <?php } ?></td>

              <td><span class="required">*</span> <?php echo $entry_time_arrival; ?></td>
              <td><input name="time_arrival" value="<?php echo $time_arrival; ?>" size="4" class="time" />
			  <?php if ($error_time_arrival) { ?>
                <span class="error"><?php echo $error_time_arrival; ?></span>
                <?php } ?></td>
				
				<td> </td>
				<td> </td>
				
            </tr>
		  	
            <tr>
				
              <td><span class="required">*</span> <?php echo $entry_flight; ?></td>
              <td><input name="flight" value="<?php echo $flight; ?>" size="4" />
			  <?php if ($error_flight) { ?>
                <span class="error"><?php echo $error_flight; ?></span>
                <?php } ?></td>
								
            </tr>
		  	
            <tr>
				
              <td><span class="required">*</span> <?php echo $entry_taxes; ?></td>
              <td><input name="taxes" value="<?php echo $taxes; ?>" size="4" />
			  <?php if ($error_taxes) { ?>
                <span class="error"><?php echo $error_taxes; ?></span>
                <?php } ?></td>
				
            </tr>
		  	
            <tr>
				
              <td><span class="required">*</span> <?php echo $entry_hotel; ?></td>
              <td><input name="hotel" value="<?php echo $hotel; ?>" size="4" />
			  <?php if ($error_hotel) { ?>
                <span class="error"><?php echo $error_hotel; ?></span>
                <?php } ?></td>
				
            </tr>
		  </table>
		 </div>
		 
		 <div id="tab-descriptions">
		  
			<table id="description" class="form">
			  <thead>
				<tr>
				  <td class="left"><?php echo $entry_active_from; ?></td>
				  <td class="left"><?php echo $entry_active_untill; ?></td>
				  <td class="left"><?php echo $entry_description; ?></td>
				  <td></td>
				</tr>
			  </thead>
			  <?php $descr_row = 0; ?>
			  <?php foreach($descriptions as $description) { ?>
				  <tbody id="descr_row<?php echo $descr_row; ?>">
					<tr>
					  <td class="left"><input type="text" name="descriptions[<?php echo $descr_row; ?>][active_from]" value="<?php echo $description['active_from']; ?>" class="date" /></td>
					  <td class="left"><input type="text" name="descriptions[<?php echo $descr_row; ?>][active_untill]" value="<?php echo $description['active_untill']; ?>" class="date" /></td>
					  <td class="left"><textarea name="descriptions[<?php echo $descr_row; ?>][description]"><?php echo $description['description']; ?></textarea></td>
					  <td class="left"><a onclick="$('#descr_row<?php echo $descr_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
					</tr>
				  </tbody>
				  <?php $descr_row++; ?>
			  <?php } ?>
			  <tfoot>
				<tr>
				  <td class="right" colspan="4"><a onclick="addDescription();" class="button"><span><?php echo $button_add_description; ?></span></a></td>
				</tr>
			  </tfoot>
			</table>

        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<?php $descr_row = 0; ?>
<?php foreach($descriptions as $description) { ?>
	<script type="text/javascript"><!--
	CKEDITOR.replace('descriptions[<?php echo $descr_row; ?>][description]', {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
	});
	//--></script> 
  <?php $descr_row++; ?>
<?php } ?>
<script type="text/javascript"><!--
var descr_row = <?php echo $descr_row; ?>;

function addDescription() {
	html  = '<tbody id="descr_row' + descr_row + '">';
	html += '<tr>'; 
    html += '<td class="left"><input type="text" name="descriptions[' + descr_row + '][active_from]" value="" class="date" /></td>';
	html += '<td class="left"><input type="text" name="descriptions[' + descr_row + '][active_untill]" value="" class="date" /></td>';
	html += '<td class="left"><textarea name="descriptions[' + descr_row + '][description]"></textarea></td>';
	html += '<td class="left"><a onclick="$(\'#descr_row' + descr_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '</tr>';
    html += '</tbody>';
	
	$('#description tfoot').before(html);
 
	$('#descr_row' + descr_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	CKEDITOR.replace('descriptions[' + descr_row + '][description]', {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
	});	
	
	descr_row++;
}
//--></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'dd-mm-yy'});
$('.time').timepicker({
						timeFormat: 'hh:mm',
						timeOnlyTitle: 'Kies tijd',
						timeText: 'Tijd',
						hourText: 'Uur',
						minuteText: 'Minuut',
						currentText: 'Nu',
						closeText: 'Sluit'
						});
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 
<?php echo $footer; ?>