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
  <?php if ($error_routeid) { ?>
  <div class="warning"><?php echo $error_routeid; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/globe-icon.png" alt="" width="24" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $entry_departure; ?></td>
              <td><input type="text" name="departure" value="<?php echo $departure; ?>" style="width:28px;" maxlength="3" tabindex="1" />
                <?php if ($error_departure) { ?>
                <span class="error"><?php echo $error_departure; ?></span>
                <?php } ?></td>
				
				<td><?php echo $entry_sell; ?></td>
				<td>
					<input type="radio" value="1" name="sell" <?php if($sell==1) echo 'checked="checked"'; ?> />Ja
					<input type="radio" value="0" name="sell" <?php if($sell!=1) echo 'checked="checked"'; ?> />Nee
				</td>
            </tr>

            <tr>
              <td><span class="required">*</span> <?php echo $entry_destination; ?></td>
              <td><input type="text" name="destination" value="<?php echo $destination; ?>" style="width:28px;" maxlength="3" tabindex="2" />
                <?php if ($error_destination) { ?>
                <span class="error"><?php echo $error_destination; ?></span>
                <?php } ?></td>
				
				<td><?php echo $entry_category; ?></td>
				<td>
					<select name="category">
						<option value="Economy" <?php if($category=='Economy') echo 'selected="selected"'; ?>>Economy</option>
						<option value="Business" <?php if($category=='Business') echo 'selected="selected"'; ?>>Business</option>
						<option value="First" <?php if($category=='First') echo 'selected="selected"'; ?>>First</option>
						<option value="Premium" <?php if($category=='Premium') echo 'selected="selected"'; ?>>Premium</option>
					</select>
				</td>
            </tr>

            <tr>
              <td><span class="required">*</span> <?php echo $entry_carrier; ?></td>
              <td><input type="text" name="carrier" value="<?php echo $carrier; ?>" style="width:20px;" maxlength="2" tabindex="3" />
                <?php if ($error_carrier) { ?>
                <span class="error"><?php echo $error_carrier; ?></span>
                <?php } ?></td>
				
				<td><?php echo $entry_tourbox; ?></td>
				<td>
					<input width="20" type="text" name="tourbox" value="<?php echo $tourbox; ?>" />
				</td>
            </tr>

            <tr>
              <td><span class="required">*</span> <?php echo $entry_klasse; ?></td>
              <td><input type="text" name="klasse" value="<?php echo $klasse; ?>" style="width:12px;" maxlength="1" tabindex="4" />
                <?php if ($error_klasse) { ?>
					<span class="error"><?php echo $error_klasse; ?></span>
                <?php } ?></td>
				
				<td><?php echo $entry_min_stay; ?></td>
				<td>
					<input width="20" type="text" name="min_stay" value="<?php echo $min_stay; ?>"/>
				</td>
            </tr>
			
			<tr>
				<td><?php echo $entry_via; ?></td>
				<td><input type="text" name="via" value="<?php echo $via; ?>" tabindex="5" /></td>
				
				<td><?php echo $entry_max_stay; ?></td>
				<td>
					<input width="20" type="text" name="max_stay" value="<?php echo $max_stay; ?>"/>
				</td>
			</tr>
			
			<tr>
				<td><?php echo $entry_days_to; ?></td>
				<td>
					<input type="checkbox" value="<?php echo $ma; ?>" name="ma" <?php if($ma==1) echo 'checked="checked"'; ?> tabindex="6" />Ma
					<input type="checkbox" value="<?php echo $di; ?>" name="di" <?php if($di==1) echo 'checked="checked"'; ?> tabindex="7" />Di
					<input type="checkbox" value="<?php echo $wo; ?>" name="wo" <?php if($wo==1) echo 'checked="checked"'; ?> tabindex="8" />Wo
					<input type="checkbox" value="<?php echo $do; ?>" name="do" <?php if($do==1) echo 'checked="checked"'; ?> tabindex="9" />Do
					<input type="checkbox" value="<?php echo $vr; ?>" name="vr" <?php if($vr==1) echo 'checked="checked"'; ?> tabindex="10" />Vr
					<input type="checkbox" value="<?php echo $za; ?>" name="za" <?php if($za==1) echo 'checked="checked"'; ?> tabindex="11" />Za
					<input type="checkbox" value="<?php echo $zo; ?>" name="zo" <?php if($zo==1) echo 'checked="checked"'; ?> tabindex="12" />Zo
				</td>
				
				<td><?php echo $entry_discount; ?></td>
				<td>
					<?php echo $entry_kind; ?> 
						<select name="kind">
							<?php foreach ($discount_kind as $dk) { ?>
								<option value="<?php echo $dk['title'];?>" <?php if($kind==$dk['title']) echo 'selected="selected"';?>><?php echo $dk['title']; ?></option>
							<?php } ?>
						</select>
												
					<?php echo $entry_baby; ?> 
						<select name="baby">
							<?php foreach ($discount_baby as $k) { ?>
								<option value="<?php echo $k['title'];?>" <?php if($baby==$k['title']) echo 'selected="selected"';?>><?php echo $k['title']; ?></option>
							<?php } ?>
						</select>
					<?php if ($error_kind) { ?>
					<span class="error"><?php echo $error_kind; ?></span>
					<?php } ?>
					<?php if ($error_baby) { ?>
					<span class="error"><?php echo $error_baby; ?></span>
					<?php } ?>
				</td>
				
			</tr>
			<tr>
				<td><?php echo $entry_days_back; ?></td>
				<td>
					<input type="checkbox" value="<?php echo $ma_b; ?>" name="ma_b" <?php if($ma_b==1) echo 'checked="checked"'; ?> tabindex="13" />Ma
					<input type="checkbox" value="<?php echo $di_b; ?>" name="di_b" <?php if($di_b==1) echo 'checked="checked"'; ?> tabindex="14" />Di
					<input type="checkbox" value="<?php echo $wo_b; ?>" name="wo_b" <?php if($wo_b==1) echo 'checked="checked"'; ?> tabindex="15" />Wo
					<input type="checkbox" value="<?php echo $do_b; ?>" name="do_b" <?php if($do_b==1) echo 'checked="checked"'; ?> tabindex="16" />Do
					<input type="checkbox" value="<?php echo $vr_b; ?>" name="vr_b" <?php if($vr_b==1) echo 'checked="checked"'; ?> tabindex="17" />Vr
					<input type="checkbox" value="<?php echo $za_b; ?>" name="za_b" <?php if($za_b==1) echo 'checked="checked"'; ?> tabindex="18" />Za
					<input type="checkbox" value="<?php echo $zo_b; ?>" name="zo_b" <?php if($zo_b==1) echo 'checked="checked"'; ?> tabindex="19" />Zo
				</td>
				
				<td><?php echo $entry_is_doorvlucht; ?></td>
				<td>
					<input type="radio" value="1" name="doorvlucht" <?php if($doorvlucht==1) echo 'checked="checked"'; ?> />Ja
					<input type="radio" value="0" name="doorvlucht" <?php if($doorvlucht!=1) echo 'checked="checked"'; ?> />Nee
				</td>
				
			</tr>
			
			<tr>
				<td><?php echo $entry_combin; ?></td>
				<td>
					<input type="radio" value="1" name="combin" <?php if($combin==1) echo 'checked="checked"'; ?> tabindex="20" />Ja
					<input type="radio" value="0" name="combin" <?php if($combin!=1) echo 'checked="checked"'; ?> />Nee
				</td>
				
				<td><?php echo $entry_doorvlucht_van; ?></td>
				<td>
					<input type="text" maxlength="9" name="doorvlucht_van" value="<?php echo $doorvlucht_van; ?>"/>
				</td>
			</tr>
			
			<tr>
				<td colspan="4"><hr /></td>
			</tr>
			
			<tr>
				<td><?php echo $entry_one_tax; ?></td>
				<td>
					<input type="radio" value="1" name="one_tax" <?php if($one_tax==1) echo 'checked="checked"'; ?> />Ja
					<input type="radio" value="0" name="one_tax" <?php if($one_tax!=1) echo 'checked="checked"'; ?> />Nee
				</td>
				
				<td><?php echo $entry_stopovers; ?></td>
				<td>
					<input type="text" name="stopovers" value="<?php echo $stopovers; ?>"/>
				</td>
			</tr>
			
			<tr>
				<td><?php echo $entry_main_segment; ?></td>
				<td>
					<input type="radio" value="1" name="main_segment" <?php if($main_segment==1) echo 'checked="checked"'; ?> />Ja
					<input type="radio" value="0" name="main_segment" <?php if($main_segment!=1) echo 'checked="checked"'; ?> />Nee
				</td>

				<td><?php echo $entry_wijzigen; ?></td>
				<td>
					<input type="text" name="wijzigen" value="<?php echo $wijzigen; ?>"/>
				</td>
			</tr>
			
			<tr>
				<td><?php echo $entry_open_jaw; ?></td>
				<td>
					<input type="radio" value="1" name="open_jaw" <?php if($open_jaw==1) echo 'checked="checked"'; ?> />Ja
					<input type="radio" value="0" name="open_jaw" <?php if($open_jaw!=1) echo 'checked="checked"'; ?> />Nee
				</td>
				
				<td><?php echo $entry_refunds; ?></td>
				<td>
					<input type="text" name="refunds" value="<?php echo $refunds; ?>"/>
				</td>
			</tr>
			
			<tr>
				<td><?php echo $entry_bagage; ?></td>
				<td>
					<input type="text" name="bagage" value="<?php echo $bagage; ?>"/>
				</td>
				



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