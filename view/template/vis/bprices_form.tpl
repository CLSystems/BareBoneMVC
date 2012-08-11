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
      <h1><img src="view/image/cash-icon.png" alt="" width="24" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_flight; ?></td>
              <td><input type="text" name="flight_id" value="<?php echo $flight_id; ?>" />
			  <?php if ($error_flight_id) { ?>
                <span class="error"><?php echo $error_flight_id; ?></span>
                <?php } ?></td>
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_departure; ?></td>
              <td><input type="text" name="departure_start" value="<?php echo $departure_start; ?>" style="width:70px;" class="date" /> <?php echo $text_untill_and; ?> <input type="text" name="departure_end" value="<?php echo $departure_end; ?>" style="width:70px;" class="date" />
                <?php if ($error_departure_start) { ?>
					<span class="error"><?php echo $error_departure_start; ?></span>
                <?php } ?>
				<?php if ($error_departure_end) { ?>
					<span class="error"><?php echo $error_departure_end; ?></span>
                <?php } ?></td>
            </tr>

            <tr>
              <td><span class="required">*</span> <?php echo $entry_price; ?></td>
              <td><input type="text" name="price" id="price" value="<?php echo $price; ?>" onKeyUp="javascript:StripIt(this.value);" />
                <?php if ($error_price) { ?>
                <span class="error"><?php echo $error_price; ?></span>
                <?php } ?></td>
            </tr>

            <tr>
              <td><span class="required">*</span> <?php echo $entry_valuta; ?></td>
              <td><input type="text" name="valuta" value="<?php echo $valuta; ?>" maxlength="3" />
                <?php if ($error_valuta) { ?>
                <span class="error"><?php echo $error_valuta; ?></span>
                <?php } ?></td>
            </tr>
			
			
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
 
function StripIt(entry)
{
out 	= ",";
add 	= ".";
temp 	= "" + entry; // temporary holder
while (temp.indexOf(out)>-1){
	pos		= temp.indexOf(out);
	temp 	= "" + (temp.substring(0, pos) + add +
	temp.substring((pos + out.length), temp.length));
}
// $('input[name=\'price\']').attr('value') = temp;
// return temp;
$('#price').val(temp);
} // end function StripIt
//-->
</script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'dd-mm-yy'});
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 

<?php echo $footer; ?>