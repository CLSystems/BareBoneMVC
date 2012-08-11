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
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a><a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'vac.airline_code') { ?>
                <a href="<?php echo $sort_airline_code; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_airline_code; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_airline_code; ?>"><?php echo $column_airline_code; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'va.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="left"><?php echo $column_description; ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td><input type="text" name="filter_airline_code" value="<?php echo $filter_airline_code; ?>" size="4" /></td>
              <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
			  <td>&nbsp;</td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($altmeals) { ?>
				<?php $class = 'odd'; ?>
				<?php foreach ($altmeals as $altmeal) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<tr class="<?php echo $class; ?>">
					  <td style="text-align: center;"><?php if ($altmeal['selected']) { ?>
						<input type="checkbox" name="selected[]" value="<?php echo $altmeal['v_a_m_r_id']; ?>" checked="checked" />
						<?php } else { ?>
						<input type="checkbox" name="selected[]" value="<?php echo $altmeal['v_a_m_r_id']; ?>" />
						<?php } ?></td>
					  <td class="left"><?php echo $altmeal['airline_code']; ?></td>
					  <td class="left"><?php echo $altmeal['name']; ?></td>
					  <td class="left"><?php echo html_entity_decode($altmeal['description']); ?></td>
					  <td class="right"><?php foreach ($altmeal['action'] as $action) { ?>
						<a href="<?php echo $action['href']; ?>"><img src="view/image/pencil.png" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" /><!-- [ <?php echo $action['text']; ?> ]--></a>
						<?php } ?></td>
					</tr>
				<?php } ?>
            <?php } else { ?>
				<tr>
				  <td class="center" colspan="5"><?php echo $text_no_results; ?></td>
				</tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=maintenance/altmeals&token=<?php echo $token; ?>';
	
	var filter_airline_code = $('input[name=\'filter_airline_code\']').attr('value');
	
	if (filter_airline_code) {
		url += '&filter_airline_code=' + encodeURIComponent(filter_airline_code);
	}
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
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