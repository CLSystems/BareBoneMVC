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
      <h1><img src="view/image/log.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><!--<a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a>
	  						
							<a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a>
							<a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a>-->
							
	</div>
    </div>
    <div class="content">
	
      <div class="pagination"><?php echo $pagination; ?></div>
	
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <!-- <td style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>-->
              <td class="left"><?php if ($sort == 'BESTEMMING') { ?>
                <a href="<?php echo $sort_destination; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_destination; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_destination; ?>"><?php echo $column_destination; ?></a>
                <?php } ?></td>
				
              <td class="left"><?php echo $column_ready; ?></td>
				
              <td class="left"><?php echo $column_route; ?></td>
				
              <td class="left"><?php echo $column_basis; ?></td>
				
              <td class="left"><?php echo $column_price; ?></td>
				
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <!-- <td></td> -->
              <td><input type="text" name="filter_destination" value="<?php echo $filter_destination; ?>"  style="width:40px;" /></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($destinationreadys) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($destinationreadys as $destinationready) { ?>
				<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
				<tr class="<?php echo $class; ?>">
				  <!-- <td style="text-align: center;"></td> -->
				  <td class="left"><?php echo $destinationready['destination']; ?></td>
				  <td class="left">
					<table border="0" cellpadding="0" cellspacing="0" class="white">
					<tbody>
						<tr>
							<td>
							<div id="ir_<?php echo $destinationready['destination']; ?>" >
							<?php if($destinationready['klaar']==$text_yes) { 
									echo '<img src="view/image/accept.png" onClick="javascript:switchDestinationReadyValue(\''. $destinationready['destination'] .'\',\'off\');" />'; 
								}else{ 
									echo '<img src="view/image/delete.png" onClick="javascript:switchDestinationReadyValue(\''. $destinationready['destination'] .'\',\'on\');" />';
								} ?>
							</div>
							</td>
						</tr>
					</tbody>
					</table>
				  </td>
				  <td class="left"><a href="<?php echo $destinationready['routeurl'];?>">
				  <?php if($destinationready['routecheck']==$text_yes) { 
						echo '<img src="view/image/accept.png" />'; 
					}else{ 
						echo '<img src="view/image/delete.png" />';
					} ?></a>
				</td>
				  <td class="left"><a href="<?php echo $destinationready['routeurl'];?>">
				  <?php if($destinationready['basischeck']==$text_yes) { 
						echo '<img src="view/image/accept.png" />'; 
					}else{ 
						echo '<img src="view/image/delete.png" />';
					} ?></a>
				</td>
				  <td class="left"><a href="<?php echo $destinationready['priceurl'];?>">
				  <?php if($destinationready['pricecheck']==$text_yes) { 
						echo '<img src="view/image/accept.png" />'; 
					}else{ 
						echo '<img src="view/image/delete.png" />';
					} ?></a>
				</td>

              <td class="right"><?php foreach ($destinationready['action'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><!-- <img src="view/image/pencil.png" width="22" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" />[ <?php echo $action['text']; ?> ]--></a>
                <?php } ?></td>
				</tr>
				<?php } ?>
            <?php } else { ?>
				<tr>
				  <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
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
function switchDestinationReadyValue(dest, val){
	$('#ir_'+dest+'').load('index.php?route=catalog/destinationready/swdestinationready&dest=' + dest + '&val=' + val + '&token=<?php echo $token; ?>');
}
</script> 
<script type="text/javascript">
function filter() {
	url = 'index.php?route=catalog/destinationready&token=<?php echo $token; ?>';
	
	var filter_destination = $('input[name=\'filter_destination\']').attr('value');
	
	if (filter_destination) {
		url += '&filter_destination=' + encodeURIComponent(filter_destination);
	}
	
	location = url;
}
</script> 
<script type="text/javascript">
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
</script> 
<?php echo $footer; ?>