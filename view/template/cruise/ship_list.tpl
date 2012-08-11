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
      <h1><img src="view/image/company.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
	  	<a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a>
		<a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a>
		<a onclick="$('#form').attr('action', '<?php echo $delete; ?>'); $('#form').submit();" class="button"><?php echo $button_delete; ?></a>
	  </div>
    </div>
    <div class="content">
	
      <div class="pagination"><?php echo $pagination; ?></div>
	
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 's.ship_name') { ?>
                <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                <?php } ?></td>
				<td></td>
              <td class="left"><?php if ($sort == 'sc.shipping_company_name') { ?>
                <a href="<?php echo $sort_company; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_company; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_company; ?>"><?php echo $column_company; ?></a>
                <?php } ?></td>
				
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td><input type="text" name="filter_title" value="<?php echo $filter_title; ?>" /></td>
			  <td></td>
              <td><select name="filter_company">
                  <option value="*" selected="selected"> </option>
                  <?php foreach ($companies as $company) { ?>
					  <?php if ($company['shipping_company_id'] == $filter_company) { ?>
						  <option value="<?php echo $company['shipping_company_id']; ?>" selected="selected"><?php echo $company['shipping_company_name']; ?></option>
					  <?php } else { ?>
						  <option value="<?php echo $company['shipping_company_id']; ?>"><?php echo $company['shipping_company_name']; ?></option>
					  <?php } ?>
                  <?php } ?>
                </select></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($ships) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($ships as $ship) { ?>
            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">
              <td style="text-align: center;"><?php if ($ship['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $ship['ship_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $ship['ship_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $ship['title']; ?></td>
              <td class="left"><?php echo $ship['shipnumber']; ?></td>
              <td class="left"><?php echo $ship['company_name']; ?></td>
			  
              <td class="right"><?php foreach ($ship['action'] as $action) { ?>
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
	url = 'index.php?route=maintenance/ship&token=<?php echo $token; ?>';
	
	var filter_title = $('input[name=\'filter_title\']').attr('value');

	if (filter_title) {
		url += '&filter_title=' + encodeURIComponent(filter_title);
	}

	var filter_company = $('select[name=\'filter_company\']').attr('value');
	
	if (filter_company != '*') {
		url += '&filter_company=' + encodeURIComponent(filter_company);
	}	
	// alert('Going to URL '+url);
	$('#form').attr('action', url);
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