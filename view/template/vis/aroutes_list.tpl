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
      <h1><img src="view/image/globe-icon.png" alt="" width="24" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
	  	<a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a>
		<a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a>
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
              <td class="left"><?php if ($sort == 'VERTREK') { ?>
                <a href="<?php echo $sort_departure; ?>" class="<?php echo strtolower($order); ?>"><img src="view/image/plane_up.jpg" alt="<?php echo $column_departure; ?>" title="<?php echo $column_departure; ?>" /></a>
                <?php } else { ?>
                <a href="<?php echo $sort_departure; ?>"><img src="view/image/plane_up.jpg" alt="<?php echo $column_departure; ?>" /></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'BESTEMMING') { ?>
                <a href="<?php echo $sort_destination; ?>" class="<?php echo strtolower($order); ?>"><img src="view/image/plane_down.jpg" alt="<?php echo $column_destination; ?>" title="<?php echo $column_destination; ?>" /></a>
                <?php } else { ?>
                <a href="<?php echo $sort_destination; ?>"><img src="view/image/plane_down.jpg" alt="<?php echo $column_destination; ?>" title="<?php echo $column_destination; ?>" /></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'CARRIER') { ?>
                <a href="<?php echo $sort_carrier; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_carrier; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_carrier; ?>"><?php echo $column_carrier; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'KLASSE') { ?>
                <a href="<?php echo $sort_klasse; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_klasse; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_klasse; ?>"><?php echo $column_klasse; ?></a>
                <?php } ?></td>
				
			  <td><?php echo $column_via;?></td>
				
			  <td><?php echo $column_days;?></td>
				
			  <td><?php echo $column_basis;?></td>
				
			  <td><?php echo $column_combin;?></td>
				
			  <td><?php echo $column_tourbox;?></td>
				
			  <td><?php echo $column_minstay;?></td>
				
			  <td><?php echo $column_maxstay;?></td>
				
			  <td><?php echo $column_discount;?></td>
				
			  <td class="left"><?php if ($sort == 'is_doorvlucht') { ?>
                <a href="<?php echo $sort_doorvlucht; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_doorvlucht; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_doorvlucht; ?>"><?php echo $column_doorvlucht; ?></a>
                <?php } ?></td>
				
			  <td><?php echo $column_doorvlucht_van;?></td>
				
              <td class="left"><?php if ($sort == 'sell') { ?>
                <a href="<?php echo $sort_sell; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sell; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sell; ?>"><?php echo $column_sell; ?></a>
                <?php } ?></td>
				
              <!-- <td class="right">prijzen</td> -->
              <td colspan="2" class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td><input type="text" name="filter_departure" value="<?php echo $filter_departure; ?>" style="width:28px;" maxlength="3" /></td>
              <td><input type="text" name="filter_destination" value="<?php echo $filter_destination; ?>" style="width:28px;" maxlength="3" /></td>
              <td><input type="text" name="filter_carrier" value="<?php echo $filter_carrier; ?>" style="width:20px;" maxlength="2" /></td>
              <td><input type="text" name="filter_klasse" value="<?php echo $filter_klasse; ?>" style="width:12px;" maxlength="1" /></td>
			  <td><input type="text" name="filter_via" value="<?php echo $filter_via; ?>" style="width:52px;" /></td>
			  <td><!-- days --></td>
			  <td><!-- basis --></td>
			  <td><!-- combin --></td>
			  <td><!-- tourbox --></td>
			  <td><!-- min_stay --></td>
			  <td><!-- max_stay --></td>
			  <td><!-- discount --></td>
			  <td><select name="filter_doorvlucht">
                  <option value="*"></option>
                  <?php if ($filter_doorvlucht) { ?>
					  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
					  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_doorvlucht) && !$filter_doorvlucht) { ?>
					  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
					  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select></td>
			  <td><!-- doorvlucht_van --></td>
              <td><select name="filter_sell">
                  <option value="*"></option>
                  <?php if ($filter_sell) { ?>
					  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
					  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_sell) && !$filter_sell) { ?>
					  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
					  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select></td>
			  <!-- <td>prices</td> -->
              <td colspan="2" align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($routes) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($routes as $route) { ?>
            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">
              <td style="text-align: center;"><?php if ($route['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $route['route_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $route['route_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $route['departure']; ?></td>
              <td class="left"><?php echo $route['destination']; ?></td>
              <td class="left"><?php echo $route['carrier']; ?></td>
              <td class="left">
			  <input name="k_<?php echo $route['route_id']; ?>" value="<?php echo $route['klasse']; ?>" style="width:12px;" onBlur="javascript:saveKlasseValue('<?php echo $route['route_id']; ?>')" />
			  	<div id="kr_<?php echo str_replace('#','_',$route['route_id']); ?>" ><?php if(is_numeric($route['klasse'])) print '<img src="view/image/up-icon.png" />'; ?></div>
			  </td>
              <td class="left">
				<input name="via_<?php echo $route['route_id']; ?>" value="<?php echo $route['via']; ?>"  style="width:52px;" onBlur="javascript:saveViaValue('<?php echo $route['route_id']; ?>')" />
			  	<div id="viar_<?php echo str_replace('#','_',$route['route_id']); ?>" > </div>			  
			  </td>
              <td class="left">
			  
			  	<table border="0" cellpadding="0" cellspacing="0" class="white">
					<tbody>
					<tr>
						<td></td>
						<td>Ma</td>
						<td>Di</td>
						<td>Wo</td>
						<td>Do</td>
						<td>Vr</td>
						<td>Za</td>
						<td>Zo</td>
					</tr>
					<tr>
						<td>&raquo;</td>
						<td><div id="ma_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['ma']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'ma\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'ma\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="di_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['di']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'di\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'di\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="wo_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['wo']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'wo\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'wo\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="do_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['do']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'do\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'do\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="vr_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['vr']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'vr\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'vr\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="za_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['za']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'za\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'za\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="zo_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['zo']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'zo\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'zo\',\'on\');" />'; ?>
							</div>
						</td>
					</tr>
					<tr>
						<td>&laquo;</td>
						<td><div id="ma_b_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['ma_b']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'ma_b\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'ma_b\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="di_b_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['di_b']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'di_b\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'di_b\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="wo_b_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['wo_b']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'wo_b\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'wo_b\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="do_b_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['do_b']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'do_b\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'do_b\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="vr_b_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['vr_b']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'vr_b\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'vr_b\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="za_b_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['za_b']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'za_b\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'za_b\',\'on\');" />'; ?>
							</div>
						</td>
						<td><div id="zo_b_<?php echo str_replace('#','_',$route['route_id']); ?>" >
							<?php ($route['zo_b']) ? print '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'zo_b\',\'off\');" />' : print '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''. $route['route_id'] .'\',\'zo_b\',\'on\');" />'; ?>
							</div>
						</td>
					</tr>
					</tbody>
				</table>
						
			  </td>
	
              <td class="left">
			  	<table border="0" cellpadding="0" cellspacing="0" class="white">
				<tbody>
					<tr>
						<td>
						<div id="basis_<?php echo str_replace('#','_',$route['route_id']); ?>" >
						<?php if($route['basis']==$text_yes) { 
								echo '<img src="view/image/accept.png" onClick="javascript:switchBasisValue(\''. $route['route_id'] .'\',\'off\');" />'; 
							}else{ 
								echo '<img src="view/image/delete.png" onClick="javascript:switchBasisValue(\''. $route['route_id'] .'\',\'on\');" />';
							} ?>
						</div>
						</td>
					</tr>
				</tbody>
				</table>
			  </td>
			  
              <td class="left">
			  	<table border="0" cellpadding="0" cellspacing="0" class="white">
				<tbody>
					<tr>
						<td>
						<div id="combin_<?php echo str_replace('#','_',$route['route_id']); ?>" >
						<?php if($route['combin']==$text_yes) { 
								echo '<img src="view/image/accept.png" onClick="javascript:switchCombinValue(\''. $route['route_id'] .'\',\'off\');" />'; 
							}else{ 
								echo '<img src="view/image/delete.png" onClick="javascript:switchCombinValue(\''. $route['route_id'] .'\',\'on\');" />';
							} ?>
						</div>
						</td>
					</tr>
				</tbody>
				</table>
			</td>
			  
              <td class="left">
			  	<input name="tb_<?php echo $route['route_id']; ?>" value="<?php echo $route['tourbox']; ?>" size="10" onBlur="javascript:saveTourboxValue('<?php echo $route['route_id']; ?>')" />
			  	<div id="tbr_<?php echo str_replace('#','_',$route['route_id']); ?>" > </div>
			</td>
			  
              <td class="left"><textarea name="min_<?php echo $route['route_id']; ?>" rows="2" cols="16" onBlur="javascript:saveMinStayValue('<?php echo $route['route_id']; ?>')" ><?php echo $route['min_stay']; ?></textarea>
			  	<div id="minr_<?php echo str_replace('#','_',$route['route_id']); ?>" > </div>
			</td>
			  
              <td class="left"><textarea name="max_<?php echo $route['route_id']; ?>" rows="2" cols="16" onBlur="javascript:saveMaxStayValue('<?php echo $route['route_id']; ?>')" ><?php echo $route['max_stay']; ?></textarea>
			  	<div id="maxr_<?php echo str_replace('#','_',$route['route_id']); ?>" > </div>
			</td>
			  
              <td class="left">
			  
			  	<table border="0" cellpadding="5" cellspacing="5" class="white">
					<tbody>
						<tr>
							<td>Kind</td>
							<td>Baby</td>
						</tr>
						<tr>
							<td><?php echo $route['kind_discount']; ?></td>
							<td><?php echo $route['baby_discount']; ?></td>
						</tr>
					</tbody>
				</table>
			  
			  </td>
			  
              <td class="left">
			  	<table border="0" cellpadding="0" cellspacing="0" class="white">
				<tbody>
					<tr>
						<td>
						<div id="dv_<?php echo str_replace('#','_',$route['route_id']); ?>" >
						<?php if($route['is_doorvlucht']==$text_yes) { 
								echo '<img src="view/image/accept.png" onClick="javascript:switchDoorvluchtValue(\''. $route['route_id'] .'\',\'off\');" />'; 
							}else{ 
								echo '<img src="view/image/delete.png" onClick="javascript:switchDoorvluchtValue(\''. $route['route_id'] .'\',\'on\');" />';
							} ?>
						</div>
						</td>
					</tr>
				</tbody>
				</table>
			</td>
			  
              <td class="left">
				<input name="dvv_<?php echo $route['route_id']; ?>" value="<?php echo $route['doorvlucht_van']; ?>" size="10" onBlur="javascript:saveDoorvluchtVanValue('<?php echo $route['route_id']; ?>')" />
			  	<div id="dvvr_<?php echo str_replace('#','_',$route['route_id']); ?>" ><?php if( ($route['is_doorvlucht']==$text_yes) && ( strlen($route['doorvlucht_van']<5) ) ) print '<img src="view/image/up-icon.png" />'; ?>
</div>
			 </td>
			  
              <td class="left"><?php echo $route['sell']; ?></td>
			  
              <td class="right">
			  	<a href="<?php echo $route['prices']; ?>"><?php ($route['price_check']) ? print ' ' : print '<img src="view/image/right-icon.png" />' ; ?><img src="view/image/coins.png" title="<?php echo $text_prices; ?>" alt="<?php echo $text_prices; ?>" /><!-- [ <?php echo $text_prices; ?> ]--></a>
			  </td>
              <td class="right"><?php foreach ($route['action'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><img src="view/image/pencil.png" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" /><!-- [ <?php echo $action['text']; ?> ]--></a>
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
s = s.replace (/%20/g, '+');
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
function saveKlasseValue(f_id){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	var val = $('input[name=\'k_'+f_id+'\']').attr('value');
	
	$('#kr_'+div_id+'').html('Saving...');
	$('#kr_'+div_id+'').load('index.php?route=vis/aroutes/saveklasse&f_id=' + fid + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script>
<script type="text/javascript">
function saveViaValue(f_id){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	var val = $('input[name=\'via_'+f_id+'\']').attr('value');
	
	$('#viar_'+div_id+'').html('Saving...');
	$('#viar_'+div_id+'').load('index.php?route=vis/aroutes/savevia&f_id=' + fid + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script>
<script type="text/javascript">
function saveMinStayValue(f_id){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	var val = $('textarea[name=\'min_'+f_id+'\']').val();
	
	$('#minr_'+div_id+'').html('Saving...');
	$('#minr_'+div_id+'').load('index.php?route=vis/aroutes/saveminstay&f_id=' + fid + '&val=' + $.URLEncode(val) + '&token=<?php echo $token; ?>', function(response, status, xhr) {
	   if (status == "error") {
		 var msg = "Sorry but there was an error: ";
		 $("#error").html(msg + xhr.status + " " + xhr.statusText);
	   }
	 });
}
</script>
<script type="text/javascript">
function saveMaxStayValue(f_id){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	var val = $('textarea[name=\'max_'+f_id+'\']').val();
	
	$('#maxr_'+div_id+'').html('Saving...');
	$('#maxr_'+div_id+'').load('index.php?route=vis/aroutes/savemaxstay&f_id=' + fid + '&val=' + $.URLEncode(val) + '&token=<?php echo $token; ?>', function(response, status, xhr) {
	   if (status == "error") {
		 var msg = "Sorry but there was an error: ";
		 $("#error").html(msg + xhr.status + " " + xhr.statusText);
	   }
	 });
}
</script>
<script type="text/javascript">
function switchDoorvluchtValue(f_id, val){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	
	$('#dv_'+div_id+'').load('index.php?route=vis/aroutes/swdoorvlucht&f_id=' + fid + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script>
<script type="text/javascript">
function saveDoorvluchtVanValue(f_id){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	var val = $('input[name=\'dvv_'+f_id+'\']').attr('value');
	
	$('#dvvr_'+div_id+'').html('Saving...');
	$('#dvvr_'+div_id+'').load('index.php?route=vis/aroutes/savedoorvluchtvan&f_id=' + fid + '&val=' + $.URLEncode(val) + '&token=<?php echo $token; ?>', function(response, status, xhr) {
	   if (status == "error") {
		 var msg = "Sorry but there was an error: ";
		 $("#error").html(msg + xhr.status + " " + xhr.statusText);
	   }
	 });

// $("#success").load('index.php?route=vis/aroutes/saveklasse&f_id=' + f_id + '&val=' + val + '&token=<?php echo $token; ?>', function(response, status, xhr) {
//   if (status == "error") {
//     var msg = "Sorry but there was an error: ";
//     $("#error").html(msg + xhr.status + " " + xhr.statusText);
//   }
// });

}
</script>
<script type="text/javascript">
function switchBasisValue(f_id, val){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	
	$('#basis_'+div_id+'').load('index.php?route=vis/aroutes/swbasis&f_id=' + fid + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script>
<script type="text/javascript">
function switchCombinValue(f_id, val){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	
	$('#combin_'+div_id+'').load('index.php?route=vis/aroutes/swcombin&f_id=' + fid + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script>
<script type="text/javascript">
function saveTourboxValue(f_id){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	var val = $('input[name=\'tb_'+f_id+'\']').attr('value');
	
	$('#tbr_'+div_id+'').html('Saving...');
	$('#tbr_'+div_id+'').load('index.php?route=vis/aroutes/savetourbox&f_id=' + fid + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script>
<script type="text/javascript">
function switchTripDay(f_id, day, val){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	
	$('#'+day+'_'+div_id+'').load('index.php?route=vis/aroutes/swtripday&f_id=' + fid + '&day=' + day + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script>
<script type="text/javascript">
function saveTourboxValue(f_id){
	var fid = $.URLEncode(f_id);
	var div_id = f_id.replace('#', '_');
	var val = $('input[name=\'tb_'+f_id+'\']').attr('value');
	
	$('#tbr_'+div_id+'').html('Saving...');
	$('#tbr_'+div_id+'').load('index.php?route=vis/aroutes/savetourbox&f_id=' + fid + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script>
<script type="text/javascript"><!-- 
function filter() {
	url = 'index.php?route=vis/aroutes&token=<?php echo $token; ?>';
	
	var filter_departure = $('input[name=\'filter_departure\']').attr('value');
	
	if (filter_departure) {
		url += '&filter_departure=' + encodeURIComponent(filter_departure);
	}
	
	var filter_destination = $('input[name=\'filter_destination\']').attr('value');
	
	if (filter_destination) {
		url += '&filter_destination=' + encodeURIComponent(filter_destination);
	}
	
	var filter_carrier = $('input[name=\'filter_carrier\']').attr('value');
	
	if (filter_carrier) {
		url += '&filter_carrier=' + encodeURIComponent(filter_carrier);
	}
	
	var filter_klasse = $('input[name=\'filter_klasse\']').attr('value');
	
	if (filter_klasse) {
		url += '&filter_klasse=' + encodeURIComponent(filter_klasse);
	}
	
	var filter_via = $('input[name=\'filter_via\']').attr('value');
	
	if (filter_via) {
		url += '&filter_via=' + encodeURIComponent(filter_via);
	}
	
	var filter_doorvlucht = $('select[name=\'filter_doorvlucht\']').attr('value');
	
	if (filter_doorvlucht != '*') {
		url += '&filter_doorvlucht=' + encodeURIComponent(filter_doorvlucht);
	}	

	var filter_sell = $('select[name=\'filter_sell\']').attr('value');
	
	if (filter_sell != '*') {
		url += '&filter_sell=' + encodeURIComponent(filter_sell);
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