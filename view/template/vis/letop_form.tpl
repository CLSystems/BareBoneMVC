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
      <h1><img src="view/image/exclamation-icon.png" alt="" width="24" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_destination; ?></td>
              <td><input type="text" name="dest" value="<?php echo $dest; ?>" />
			  <?php if ($error_dest) { ?>
                <span class="error"><?php echo $error_dest; ?></span>
                <?php } ?></td>
            </tr>
		  
            <tr>
              <td><span class="required">*</span> <?php echo $entry_carrier; ?></td>
              <td><input type="text" name="carrier" value="<?php echo $carrier; ?>" />
			  <?php if ($error_carrier) { ?>
                <span class="error"><?php echo $error_carrier; ?></span>
                <?php } ?></td>
            </tr>

            <tr>
              <td><span class="required">*</span> <?php echo $entry_letop; ?></td>
              <td><textarea name="letop" rows="5" cols="40"><?php echo $letop;?></textarea>
                <?php if ($error_letop) { ?>
                <span class="error"><?php echo $error_letop; ?></span>
                <?php } ?></td>
            </tr>

			
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
//--></script> 
<?php echo $footer; ?>