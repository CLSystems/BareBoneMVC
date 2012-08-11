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
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_airline_code; ?></td>
              <td><input type="text" name="airline_code" value="<?php echo $airline_code; ?>" />
			  <?php if ($error_airline_code) { ?>
                <span class="error"><?php echo $error_airline_code; ?></span>
                <?php } ?></td>
            </tr>
		  
            <tr>
              <td><?php echo $entry_description; ?></td>
              <td><textarea name="description" id="description"><?php echo $description; ?></textarea>
			  <?php if ($error_description) { ?>
                <span class="error"><?php echo $error_description; ?></span>
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
<script type="text/javascript"><!--
$('input[name=\'airline_code\']').autocomplete({
	delay: 2,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=maintenance/altseats/autocomplete&token=<?php echo $token; ?>&filter_airline_code=' +  encodeURIComponent(request.term) + '',
			type: 'POST',
			dataType: 'json',
			success: function(data) {
				response($.map(data, function(item) {
					return {
						label: item.name,
						value: item.code
					} // END return
				})); // END response
			} // END success
		}); // END ajax

	},
	select: function(event, ui) {
		$('input[name=\'airline_code\']').val('' + ui.item.value + '');
		return false;
	} // END source:
}); // END autocomplete
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 
<?php echo $footer; ?>