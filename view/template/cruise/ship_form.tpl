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
              <td><?php echo $entry_company; ?></td>
              <td><select name="company_id">
                  <option value="0" selected="selected"><?php echo $text_select; ?></option>
                  <?php foreach ($companies as $company) { ?>
					  <?php if ($company['shipping_company_id'] == $company_id) { ?>
						  <option value="<?php echo $company['shipping_company_id']; ?>" selected="selected"><?php echo $company['shipping_company_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $company['shipping_company_id']; ?>"><?php echo $company['shipping_company_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>

            <tr>
              <td><span class="required">*</span> <?php echo $entry_title; ?></td>
              <td><input type="text" name="title" value="<?php echo $title; ?>" />
			  <?php if ($error_title) { ?>
                <span class="error"><?php echo $error_title; ?></span>
                <?php } ?></td>
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_shipnumber; ?></td>
              <td><input type="text" name="shipnumber" value="<?php echo $shipnumber; ?>" />
			  <?php if ($error_shipnumber) { ?>
                <span class="error"><?php echo $error_shipnumber; ?></span>
                <?php } ?></td>
            </tr>
		  </table>
		 </div>
		 
		 <div id="tab-descriptions">
		  
			<table id="description" class="form">
			  <thead>
				<tr>
				  <td class="left"><span class="required">*</span> <?php echo $entry_active_from; ?></td>
				  <td class="left"><span class="required">*</span> <?php echo $entry_active_untill; ?></td>
				  <td class="left"><span class="required">*</span> <?php echo $entry_impression; ?></td>
				  <td class="left"><span class="required">*</span> <?php echo $entry_facilities; ?></td>
				  <td class="left"><span class="required">*</span> <?php echo $entry_boatdata; ?></td>
				  <td></td>
				</tr>
			  </thead>
			  <?php $descr_row = 0; ?>
			  <?php foreach($descriptions as $description) { ?>
				  <tbody id="descr_row<?php echo $descr_row; ?>">
					<tr>
					  <td class="left"><input type="text" name="descriptions[<?php echo $descr_row; ?>][active_from]" value="<?php echo $description['active_from']; ?>" class="date" /></td>
					  <td class="left"><input type="text" name="descriptions[<?php echo $descr_row; ?>][active_untill]" value="<?php echo $description['active_untill']; ?>" class="date" /></td>
						<td class="left"><textarea name="descriptions[<?php echo $descr_row; ?>][impression]"><?php echo $description['impression']; ?></textarea></td>
						<td class="left"><textarea name="descriptions[<?php echo $descr_row; ?>][facilities]"><?php echo $description['facilities']; ?></textarea></td>
						<td class="left"><textarea name="descriptions[<?php echo $descr_row; ?>][boatdata]"><?php echo $description['boatdata']; ?></textarea></td>
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
<script type="text/javascript"><!--
<?php $descr_row = 0; ?>
<?php foreach($descriptions as $description) { ?>

		CKEDITOR.replace('descriptions[<?php echo $descr_row; ?>][impression]', {
			filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			toolbar: 'Minimal'
		});

		CKEDITOR.replace('descriptions[<?php echo $descr_row; ?>][facilities]', {
			filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			toolbar: 'Minimal'
		});

		CKEDITOR.replace('descriptions[<?php echo $descr_row; ?>][boatdata]', {
			filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			toolbar: 'Minimal'
		});
		
  <?php $descr_row++; ?>
<?php } ?>
//--></script> 

<script type="text/javascript"><!--
var descr_row = <?php echo $descr_row; ?>;

function addDescription() {
	descr_row++;
	html  = '<tbody id="descr_row' + descr_row + '">';
	html += '<tr>'; 
    html += '<td class="left"><input type="text" name="descriptions[' + descr_row + '][active_from]" value="" class="date" /></td>';
	html += '<td class="left"><input type="text" name="descriptions[' + descr_row + '][active_untill]" value="" class="date" /></td>';
	html += '<td class="left"><textarea name="descriptions[' + descr_row + '][impression]"></textarea></td>';
	html += '<td class="left"><textarea name="descriptions[' + descr_row + '][facilities]"></textarea></td>';
	html += '<td class="left"><textarea name="descriptions[' + descr_row + '][boatdata]"></textarea></td>';
	html += '<td class="left"><a onclick="$(\'#descr_row' + descr_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '</tr>';
    html += '</tbody>';
	
	$('#description tfoot').before(html);
 
	$('#descr_row' + descr_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});

	CKEDITOR.replace('descriptions[' + descr_row + '][impression]', {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		toolbar: 'Minimal'
	});

	CKEDITOR.replace('descriptions[' + descr_row + '][facilities]', {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		toolbar: 'Minimal'
	});

	CKEDITOR.replace('descriptions[' + descr_row + '][boatdata]', {
		filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
		toolbar: 'Minimal'
	});
	
	// descr_row++;
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