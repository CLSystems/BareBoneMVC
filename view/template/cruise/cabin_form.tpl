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
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-descriptions"><?php echo $tab_descriptions; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_title; ?></td>
              <td><select name="cabin_type_id">
                  <option value="0" selected="selected"><?php echo $text_select; ?></option>
                  <?php foreach ($cabintypes as $cabintype) { ?>
					  <?php if ($cabintype['cabin_type_id'] == $cabin_type_id) { ?>
						  <option value="<?php echo $cabintype['cabin_type_id']; ?>" selected="selected"><?php echo $cabintype['cabin_type_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $cabintype['cabin_type_id']; ?>"><?php echo $cabintype['cabin_type_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>

            <tr>
              <td><span class="required">*</span> <?php echo $entry_category; ?></td>
              <td><select name="category_id">
                  <option value="0" selected="selected"><?php echo $text_select; ?></option>
                  <?php foreach ($categories as $cabincategory) { ?>
					  <?php if ($cabincategory['cabin_category_id'] == $category_id) { ?>
						  <option value="<?php echo $cabincategory['cabin_category_id']; ?>" selected="selected"><?php echo $cabincategory['cabin_category_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $cabincategory['cabin_category_id']; ?>"><?php echo $cabincategory['cabin_category_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>

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
                </select></td>
            </tr>
		</table>
		 </div>
		 
		 <div id="tab-descriptions">
		  
			<table id="description" class="form">
			  <thead>
				<tr>
				  <td class="left"><span class="required">*</span> <?php echo $entry_active_from; ?></td>
				  <td class="left"><span class="required">*</span> <?php echo $entry_active_untill; ?></td>
				  <td class="left"><span class="required">*</span> <?php echo $entry_description; ?></td>
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
<script type="text/javascript" src="view/javascript/jquery/ui/ui.datepicker.js"></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 
<?php echo $footer; ?>