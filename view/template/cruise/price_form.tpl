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
              <td><span class="required">*</span> <?php echo $entry_cruise; ?></td>
              <td><select name="cruise_id" id="cruise_id" <?php if(!$cabin_id) echo ' onchange="getCabinDropdown(this.value);"'; ?> >
                  <option value="0" selected="selected"><?php echo $text_select; ?></option>
                  <?php foreach ($cruises as $cruise) { ?>
				  
					  	<?php 
							$d1 = explode('-', $cruise['date_departure']);
							$date_dep = date('d-m-Y', gmmktime(0,0,0,$d1[1],$d1[2],$d1[0]));
							$d2 = explode('-', $cruise['date_arrival']);
							$date_arr = date('d-m-Y', gmmktime(0,0,0,$d2[1],$d2[2],$d2[0]));
						?>
				  
					  <?php if ($cruise['cruise_id'] == $cruise_id) { ?>
						  <option value="<?php echo $cruise['cruise_id']; ?>" selected="selected"><?php echo $cruise['route_title']; ?> | <?php echo $cruise['ship_name']; ?> | <?php echo $cruise['port_departure']; ?> | <?php echo $date_dep; ?> | <?php echo $cruise['port_arrival']; ?> | <?php echo $date_arr; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $cruise['cruise_id']; ?>"><?php echo $cruise['route_title']; ?> | <?php echo $cruise['ship_name']; ?> | <?php echo $cruise['port_departure']; ?> | <?php echo $date_dep; ?> | <?php echo $cruise['port_arrival']; ?> | <?php echo $date_arr; ?></option>
					  <?php } ?>
				<?php } ?>
                </select>
				<?php if ($error_cruise_id) { ?>
                <span class="error"><?php echo $error_cruise_id; ?></span>
                <?php } ?>
				</td>
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_cabin; ?></td>
              <td><?php if($cabin_id) { ?>
					<select name="cabin_id">
					  <option value="0" selected="selected"><?php echo $text_select; ?></option>
					  <?php foreach ($cabins as $cabin) { ?>
						  <?php if ($cabin['cabin_id'] == $cabin_id) { ?>
							  <option value="<?php echo $cabin['cabin_id']; ?>" selected="selected"><?php echo $cabin['cabin_type_name']; ?> | <?php echo $cabin['cabin_category_name']; ?></option>
						  <?php } else { ?>
							  <option value="<?php echo $cabin['cabin_id']; ?>"><?php echo $cabin['cabin_type_name']; ?> | <?php echo $cabin['cabin_category_name']; ?></option>
						  <?php } ?>
					  <?php } ?>
					</select>
				<?php }else{ ?>
					<div id="choosecabins"><?php echo $text_choose_cruise; ?></div>
				<?php } ?>
				<?php if ($error_cabin_id) { ?>
                <span class="error"><?php echo $error_cabin_id; ?></span>
                <?php } ?>
				</td>
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_price; ?></td>
              <td><input name="price" id="price" value="<?php echo $price; ?>" size="8" onKeyUp="javascript:StripIt(this.value);" />
			  <?php if ($error_price) { ?>
                <span class="error"><?php echo $error_price; ?></span>
                <?php } ?></td>
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_own_commission; ?></td>
              <td><input name="own_commission" id="own_commission" value="<?php echo $own_commission; ?>" size="8" />
			  <?php if ($error_own_commission) { ?>
                <span class="error"><?php echo $error_own_commission; ?></span>
                <?php } ?></td>
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_agent_commission; ?></td>
              <td><input name="agent_commission" id="agent_commission" value="<?php echo $agent_commission; ?>" size="8" />
			  <?php if ($error_agent_commission) { ?>
                <span class="error"><?php echo $error_agent_commission; ?></span>
                <?php } ?></td>
            </tr>
		  	
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function getCabinDropdown(cruiseid){
	$('#choosecabins').hide().html('Loading...').fadeIn('slow');
	$('#choosecabins').load('index.php?route=maintenance/price/getcabinsdropdownbycruiseid&cruise_id='+cruiseid+'&token=<?php echo $token?>', function(response, status, xhr) {
	  if (status == "error") {
		var msg = "Sorry but there was an error: ";
		alert(msg + xhr.status + " " + xhr.statusText);
	  }
	});
}
//--></script>
<script type="text/javascript"><!--
function StripIt(entry){
	out 	= ",";
	add 	= ".";
	temp 	= "" + entry; // temporary holder
	while (temp.indexOf(out)>-1){
		pos		= temp.indexOf(out);
		temp 	= "" + (temp.substring(0, pos) + add +
		temp.substring((pos + out.length), temp.length));
	}
	$('#price').val(temp);
} // end function StripIt
//-->
</script>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 
<?php echo $footer; ?>