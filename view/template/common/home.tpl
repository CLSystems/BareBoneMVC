<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_install) { ?>
  <div class="warning"><?php echo $error_install; ?></div>
  <?php } ?>
  <?php if ($error_image) { ?>
  <div class="warning"><?php echo $error_image; ?></div>
  <?php } ?>
  <?php if ($error_image_cache) { ?>
  <div class="warning"><?php echo $error_image_cache; ?></div>
  <?php } ?>
  <?php if ($error_cache) { ?>
  <div class="warning"><?php echo $error_cache; ?></div>
  <?php } ?>
  <?php if ($error_logs) { ?>
  <div class="warning"><?php echo $error_logs; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/home-icon.png" alt="" /> <?php echo $heading_title; ?></h1>
    </div>
    <div class="content">
      <!-- <div class="overview">
        <div class="dashboard-heading"><?php echo $text_overview; ?></div>
        <div class="dashboard-content">
          <table>
            <tr>
              <td></td>
              <td></td>
            </tr>
          </table>
        </div>
      </div> -->
	  
      <!-- <div class="statistic">
        <div class="range"><?php echo $entry_range; ?>
         <select id="range" onchange="getSalesChart(this.value)">
            <option value="day"><?php echo $text_day; ?></option>
            <option value="week"><?php echo $text_week; ?></option>
            <option value="month"><?php echo $text_month; ?></option>
            <option value="year"><?php echo $text_year; ?></option>
          </select>
        </div>
        <div class="dashboard-heading"><?php echo $text_statistics; ?></div>
        <div class="dashboard-content">
          <div id="report" style="width: 390px; height: 170px; margin: auto;"></div>
        </div>
      </div> -->
	  
      <!--<div class="latest">
         <div class="dashboard-heading"><?php // echo $text_latest_10_orders; ?></div>
        <div class="dashboard-content">
          <table class="list">
            <thead>
              <tr>
                <td class="right"><?php // echo $column_order; ?></td>
                <td class="left"><?php // echo $column_customer; ?></td>
                <td class="left"><?php // echo $column_status; ?></td>
                <td class="left"><?php // echo $column_date_added; ?></td>
                <td class="right"><?php // echo $column_total; ?></td>
                <td class="right"><?php // echo $column_action; ?></td>
              </tr>
            </thead>
            <tbody>
              <?php // if ($orders) { ?>
              <?php // foreach ($orders as $order) { ?>
              <tr>
                <td class="right"><?php // echo $order['order_id']; ?></td>
                <td class="left"><?php // echo $order['customer']; ?></td>
                <td class="left"><?php // echo $order['status']; ?></td>
                <td class="left"><?php // echo $order['date_added']; ?></td>
                <td class="right"><?php // echo $order['total']; ?></td>
                <td class="right"><?php // foreach ($order['action'] as $action) { ?>
                  [ <a href="<?php // echo $action['href']; ?>"><?php // echo $action['text']; ?></a> ]
                  <?php // } ?></td>
              </tr>
              <?php // } ?>
              <?php // } else { ?>
              <tr>
                <td class="center" colspan="6"><?php // echo $text_no_results; ?></td>
              </tr>
              <?php//  } ?>
            </tbody>
          </table>
        </div> -->
		
		
		<center><img src="view/image/View.jpg" width="640" /></center>
		
      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>