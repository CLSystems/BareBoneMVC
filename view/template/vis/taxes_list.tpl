<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/log.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"> </div>
    </div>
    <div class="content">
	
      <iframe src="<?php echo $frame_url;?>" width="100%" height="640px" frameborder="0"></iframe>
	  
    </div>
  </div>
</div>

<?php echo $footer; ?>