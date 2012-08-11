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
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_ship; ?></td>
              <td><select name="ship_id">
                  <option value="0" selected="selected"><?php echo $text_select; ?></option>
                  <?php foreach ($ships as $ship) { ?>
					  <?php if ($ship['ship_id'] == $ship_id) { ?>
						  <option value="<?php echo $ship['ship_id']; ?>" selected="selected"><?php echo $ship['ship_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $ship['ship_id']; ?>"><?php echo $ship['ship_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select>
				<?php if ($error_ship_id) { ?>
                <span class="error"><?php echo $error_ship_id; ?></span>
                <?php } ?>
				</td>
			</tr>
			
			<tr>
              <td><span class="required">*</span> <?php echo $entry_route_title; ?></td>
              <td colspan="3"><input name="route_title" value="<?php echo $route_title; ?>" size="40" />
			  <?php if ($error_route_title) { ?>
                <span class="error"><?php echo $error_route_title; ?></span>
                <?php } ?></td>
            </tr>
		  	
            <tr>
              <td><span class="required">*</span> <?php echo $entry_port_departure; ?></td>
              <td><input name="port_departure" value="<?php echo $port_departure; ?>" size="4" maxlength="3" />
			  <?php if ($error_port_departure) { ?>
                <span class="error"><?php echo $error_port_departure; ?></span>
                <?php } ?></td>
            </tr>
		  	
            <tr>
              <td><span class="required">*</span> <?php echo $entry_port_arrival; ?></td>
              <td><input name="port_arrival" value="<?php echo $port_arrival; ?>" size="4" maxlength="3" />
			  <?php if ($error_port_arrival) { ?>
                <span class="error"><?php echo $error_port_arrival; ?></span>
                <?php } ?></td>
				
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_transfers; ?></td>
              <td><input name="transfers" value="<?php echo $transfers; ?>" />
			  <?php if ($error_transfers) { ?>
                <span class="error"><?php echo $error_transfers; ?></span>
                <?php } ?></td>
			
			</tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_handling; ?></td>
              <td><input name="handling" value="<?php echo $handling; ?>" />
			  <?php if ($error_handling) { ?>
                <span class="error"><?php echo $error_handling; ?></span>
                <?php } ?></td>
			
			</tr>
			
            <tr>
              <td><span class="required">*</span> <?php echo $entry_harbours; ?></td>
              <td><input name="harbours" value="<?php echo $harbours; ?>" />
			  <?php if ($error_harbours) { ?>
                <span class="error"><?php echo $error_harbours; ?></span>
                <?php } ?></td>
			
			</tr>
			
			<tr>
			
              <td><span class="required">*</span> <?php echo $entry_tax_harbours; ?></td>
              <td colspan="3"><input name="tax_harbours" value="<?php echo $tax_harbours; ?>" />
			  <?php if ($error_tax_harbours) { ?>
                <span class="error"><?php echo $error_tax_harbours; ?></span>
                <?php } ?></td>
				
            </tr>
		  
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
CKEDITOR.replace('description', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
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