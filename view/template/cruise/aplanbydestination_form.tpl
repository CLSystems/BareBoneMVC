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
      <h1><img src="view/image/globe-icon.png" alt="" width="24" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
	  	 
		</div>
    </div>
    <div class="content">

      <form action="" method="post" enctype="multipart/form-data" id="form">

          <table class="form">
		  
            <tr>
              <td class="left"><?php echo $entry_port_departure; ?>&nbsp;<input type="text" id="port_departure" value="<?php echo $port_departure; ?>" size="8" /></td>
              <td class="left"><?php echo $entry_port_arrival; ?>&nbsp;<input type="text" id="port_arrival" value="<?php echo $port_arrival; ?>" size="8" /></td>
			  <td class="left"><a onclick="getRoutesInfo();" class="button"><?php echo $button_search; ?></a></td>
            </tr>
		  
            <tr>
              <td colspan="4">
			  	<div id="routesinfo"> </div>
				<div style="clear:both;"></div>
			  	<div id="hutinfo"> </div>
			  </td>
            </tr>

          </table>

      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function getRoutesInfo(){
	var depart_port = $("#port_departure").val();
	var arrival_port = $("#port_arrival").val();
	$('#routesinfo').hide().html('Loading...').fadeIn('slow');
	$('#hutinfo').hide().html(' ').fadeIn('fast');
	$('#routesinfo').load('index.php?route=cruise/aplanbydestination/getrouteinfo&dep_port='+depart_port+'&arr_port='+arrival_port+'&token=<?php echo $token?>', function(response, status, xhr) {
	  if (status == "error") {
		var msg = "Sorry but there was an error: ";
		alert(msg + xhr.status + " " + xhr.statusText);
	  }else{
		$("img[rel]").each(function(i) {
			$(this).overlay({
				// common configuration for each overlay
				oneInstance: true, 
				closeOnClick: false 
			});			
		});
	  } // end if/else
	}); // end .load
}


//-->
</script>
<script type="text/javascript"><!--
function getCabins(cruiseid, rowid){
	$('#hutinfo').hide().html('Loading...').fadeIn('slow');
	$("tr[id^='tr_']").each(function(){
		$(this).removeClass("marked");
	});
	$("#tr_"+rowid+"").addClass("marked");
	$('#hutinfo').load('index.php?route=cruise/aplanbydestination/getcabinsinfo&cruise_id='+cruiseid+'&token=<?php echo $token?>', function(response, status, xhr) {
	  if (status == "error") {
		var msg = "Sorry but there was an error: ";
		alert(msg + xhr.status + " " + xhr.statusText);
	  }else{
		$("img[rel]").each(function(i) {
			$(this).overlay({
				// common configuration for each overlay
				oneInstance: true, 
				closeOnClick: false 
			});			
		});
	  } // end if/else
	}); // end .load
}


//-->
</script>
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		getRoutesInfo();
	}
});
//--></script> 

<?php echo $footer; ?>