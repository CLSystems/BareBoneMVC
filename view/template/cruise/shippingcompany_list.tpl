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
              <td class="left"><?php if ($sort == 'shipping_company_name') { ?>
                <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                <?php } ?></td>
				
			  <td class="left"><?php echo $column_phone;?></td>
				
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td><input type="text" name="filter_title" value="<?php echo $filter_title; ?>" /></td>
			  <td><!-- phone --></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($shippingcompanies) { ?>
			<?php $class = 'odd'; ?>
            <?php foreach ($shippingcompanies as $shippingcompany) { ?>
            <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
			<tr class="<?php echo $class; ?>">
              <td style="text-align: center;"><?php if ($shippingcompany['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $shippingcompany['shipping_company_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $shippingcompany['shipping_company_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $shippingcompany['title']; ?></td>
              <td class="left"><?php echo $shippingcompany['phone']; ?></td>
			  
              <td class="right"><?php foreach ($shippingcompany['action'] as $action) { ?>
                <a href="<?php echo $action['href']; ?>"><img src="view/image/pencil.png" title="<?php echo $action['text']; ?>" alt="<?php echo $action['text']; ?>" /><!-- [ <?php echo $action['text']; ?> ]--></a>
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=maintenance/shippingcompany&token=<?php echo $token; ?>';
	
	var filter_title = $('input[name=\'filter_title\']').attr('value');

	if (filter_title) {
		url += '&filter_title=' + encodeURIComponent(filter_title);
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