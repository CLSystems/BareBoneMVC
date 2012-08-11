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
      <h1><img src="view/image/cash-icon.png" alt="" width="24" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a>
	  						<!--
							<a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a>-->
							<a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a>
							
	</div>
    </div>
    <div class="content">
	
      <div class="pagination"><?php echo $pagination; ?></div>
	
      <form action="<?php echo $delperiods; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'f_id') { ?>
                <a href="<?php echo $sort_flight; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_flight; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_flight; ?>"><?php echo $column_flight; ?></a>
                <?php } ?></td>
				
              <td class="left"><?php if ($sort == 'departure') { ?>
                <a href="<?php echo $sort_departure; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_departure; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_departure; ?>"><?php echo $column_departure; ?></a>
                <?php } ?></td>
				
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td><input type="text" name="filter_flight" value="<?php echo $filter_flight; ?>"  style="width:70px;" /></td>
              <td><input type="text" name="filter_departure_start" value="<?php echo $filter_departure_start; ?>"  style="width:70px;" class="date" /> <?php echo $text_untill_and; ?> <input type="text" name="filter_departure_end" value="<?php echo $filter_departure_end; ?>" style="width:70px;" class="date" /></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($prices) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($prices as $price) { ?>
            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">
              <td style="text-align: center;"><?php if ($price['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $price['flight_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $price['flight_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $price['flight_id']; ?></td>
              <td class="left">
			  	<table border="0" cellpadding="5" cellspacing="5" class="white" width="400">
				<tbody>
			  	<?php 
					foreach($price['departures'] as $departure){
						echo "<tr>
								<td class=center width=90>".$departure['from']."</td>
								<td class=center width=30>".$text_untill_and."</td>
								<td class=center width=90>".$departure['untill']."</td>
								<td class=left width=20>&rArr;</td>
								<td class=right width=50>&nbsp;".(int)$departure['price']."</td>
								<td class=right width=120><a href='".$departure['href']."'>".$departure['text']."</a></td>
							</tr>";
					}
				?>
				</tbody>
				</table>
			  </td>
              <td class="right"><?php foreach ($price['action'] as $action) { ?>
                 <a href="<?php echo $action['href']; ?>"><img src="view/image/pencil.png" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" /><!-- [ <?php echo $action['text']; ?> ]--></a>
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="17"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>

    </div>
  </div>
</div>

<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'dd-mm-yy'});
//--></script>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=catalog/prices&token=<?php echo $token; ?>';
	
	var filter_flight = $('input[name=\'filter_flight\']').attr('value');
	
	if (filter_flight) {
		url += '&filter_flight=' + encodeURIComponent(filter_flight);
	}
	
	var filter_departure_start = $('input[name=\'filter_departure_start\']').attr('value');
	
	if (filter_departure_start) {
		url += '&filter_departure_start=' + encodeURIComponent(filter_departure_start);
	}
	
	var filter_departure_end = $('input[name=\'filter_departure_end\']').attr('value');
	
	if (filter_departure_end) {
		url += '&filter_departure_end=' + encodeURIComponent(filter_departure_end);
	}
	
	var filter_price = $('input[name=\'filter_price\']').attr('value');
	
	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
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