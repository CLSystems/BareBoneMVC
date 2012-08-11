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
      <h1><img src="view/image/exclamation-icon.png" alt="" width="24" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a>
						  <!-- <a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a>-->
						  <a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a>
	  </div>
    </div>
    <div class="content">
	
      <div class="pagination"><?php echo $pagination; ?></div>
	
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'best') { ?>
                <a href="<?php echo $sort_destination; ?>" class="<?php echo strtolower($order); ?>"><img src="view/image/plane_down.jpg" alt="<?php echo $column_destination; ?>" title="<?php echo $column_destination; ?>" /></a>
                <?php } else { ?>
                <a href="<?php echo $sort_destination; ?>"><img src="view/image/plane_down.jpg" alt="<?php echo $column_destination; ?>" title="<?php echo $column_destination; ?>" /></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'carrier') { ?>
                <a href="<?php echo $sort_carrier; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_carrier; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_carrier; ?>"><?php echo $column_carrier; ?></a>
                <?php } ?></td>
				
			  <td class="left"><?php echo $column_letop;?></td>
				
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td><input type="text" name="filter_destination" value="<?php echo $filter_destination; ?>" style="width:28px;" maxlength="3" /></td>
              <td><input type="text" name="filter_carrier" value="<?php echo $filter_carrier; ?>" style="width:20px;" maxlength="2" /></td>
			  <td><!-- letop --></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($letops) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($letops as $letop) { ?>
            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">
              <td style="text-align: center;"><?php if ($letop['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $letop['dest'].$letop['carrier']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $letop['dest'].$letop['carrier']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $letop['dest']; ?></td>
              <td class="left"><?php echo $letop['carrier']; ?></td>
              <td class="left">
			  	<textarea id="letop_<?php echo $letop['dest'];?>_<?php echo $letop['carrier']; ?>" rows="2" cols="80" onblur="javascript:saveLetOpValue('<?php echo $letop['dest'];?>','<?php echo $letop['carrier'];?>');"><?php echo $letop['letop']; ?></textarea>
				<div id="lor_<?php echo $letop['dest'];?>_<?php echo $letop['carrier']; ?>"> </div>
			</td>
              <td class="right"><?php foreach ($letop['action'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><!-- <img src="view/image/pencil.png" width="22" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" />[ <?php echo $action['text']; ?> ]--></a>
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="18"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript">
$.extend ({
URLEncode: function (s) {
s = encodeURIComponent (s);
s = s.replace (/\~/g, '%7E').replace (/\!/g, '%21').replace (/\(/g, '%28').replace (/\)/g, '%29').replace (/\'/g, '%27');
// s = s.replace (/%20/g, '+');
return s;
},
URLDecode: function (s) {
s = s.replace (/\+/g, '%20');
s = decodeURIComponent (s);
return s;
}
});
</script>
<script type="text/javascript">
function saveLetOpValue(dest, carr){
	var val = $('#letop_'+dest+'_'+carr+'').val();
	
	$('#lor_'+dest+'_'+carr+'').html('Saving...');
	$('#lor_'+dest+'_'+carr+'').load('index.php?route=vis/letop/saveletop&dest=' + dest + '&carr=' + carr + '&val=' + $.URLEncode(val) + '&token=<?php echo $token; ?>');
	
// $("#success").load('index.php?route=catalog/letop/saveletop&dest=' + dest + '&carr=' + carr + '&val=' + $.URLEncode(val) + '&token=<?php echo $token; ?>', function(response, status, xhr) {
//   if (status == "error") {
//     var msg = "Sorry but there was an error: ";
//     $("#error").html(msg + xhr.status + " " + xhr.statusText);
//   }
// });
	
}
</script>
<script type="text/javascript"><!-- 
function filter() {
	url = 'index.php?route=vis/letop&token=<?php echo $token; ?>';
	
	var filter_destination = $('input[name=\'filter_destination\']').attr('value');
	
	if (filter_destination) {
		url += '&filter_destination=' + encodeURIComponent(filter_destination);
	}
	
	var filter_carrier = $('input[name=\'filter_carrier\']').attr('value');
	
	if (filter_carrier) {
		url += '&filter_carrier=' + encodeURIComponent(filter_carrier);
	}
	
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