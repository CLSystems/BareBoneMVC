<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/cash-icon.png" alt="" width="24" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
	  <!-- <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a> --></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">

          <table class="form">
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_copy_from; ?></td>
              <td><input type="text" name="copy_from" id="copy_from" value="<?php echo $copy_from; ?>" maxlength="9" onblur="javascript: getPrices(this.value);" />
				<?php if ($error_copy_from) { ?>
					<span class="error"><?php echo $error_copy_from; ?></span>
                <?php } ?>			  </td>
			  <td><div id="copy_from_result"> </div>
			  <?php if ($error_nothing_selected) { ?>
					<span class="error"><?php echo $error_nothing_selected; ?></span>
                <?php } ?>
			  </td>
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_copy_to; ?></td>
              <td><input type="text" name="copy_to" id="copy_to" value="<?php echo $copy_to; ?>" maxlength="9" onblur="javascript: checkFlight(this.value);" />
			  <?php if ($error_copy_to) { ?>
					<span class="error"><?php echo $error_copy_to; ?></span>
                <?php } ?>
			  </td>
			  <td><div id="copy_to_result"> </div></td>
            </tr>
		  
            <tr>
              <td class="center" colspan="2"><a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a></td>
			  <td><div id="copy_result"> </div></td>
            </tr>
			
          </table>

      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function getPrices(flightid){
	$('#copy_from_result').hide().html('Loading...').fadeIn('slow');
	$('#copy_from_result').load('index.php?route=vis/bpricescopy/getpricesinfo&flight_id='+flightid+'&token=<?php echo $token; ?>', function(response, status, xhr) {
	  if (status == "error") {
		var msg = "Sorry but there was an error: ";
		alert(msg + xhr.status + " " + xhr.statusText);
	  }
	});
}

function checkFlight(flightid){
	$('#copy_to_result').hide().html('Loading...').fadeIn('slow');
	$('#copy_to_result').load('index.php?route=vis/bpricescopy/checkflightinfo&flight_id='+flightid+'&token=<?php echo $token; ?>', function(response, status, xhr) {
	  if (status == "error") {
		var msg = "Sorry but there was an error: ";
		alert(msg + xhr.status + " " + xhr.statusText);
	  }
	});
}

//--></script>
<?php echo $footer; ?>