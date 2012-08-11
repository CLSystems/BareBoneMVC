<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" xml:lang="<?php echo $lang; ?>">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="view/javascript/jquery/jquery.tools.min.js"></script>
<!-- <script type="text/javascript" src="view/javascript/jquery/jquery-1.6.1.min.js"></script> -->
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="view/javascript/jquery/ui/external/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript" src="view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="view/javascript/jquery/superfish/js/superfish.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });

    // Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
});
</script>
</head>
<body>

<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><img src="view/image/logo_sj.gif" title="<?php echo $heading_title; ?>" onclick="location = '<?php echo $home; ?>'" /></div>
		
<div class="seasons">
	<ul>
	<?php echo $vis_html; ?>	
	</ul>
</div> <!-- end seasons -->
	
		
    <?php if ($logged) { ?>
		<div class="div3"><img src="view/image/lock.png" alt="" style="position: relative; top: 3px;" />&nbsp;<?php echo $logged; ?><!-- &nbsp;<?php // echo $group_id; ?> --></div>
    <?php } ?>
	
  </div>
	<?php if ($logged) { ?>
	  <div id="menu">
		<ul class="left" style="display: none;">
		
		  <li id="dashboard"><a href="<?php echo $home; ?>" class="top"><?php echo $text_dashboard; ?></a></li>
		  
		  <?php foreach($menu as $m) { ?>
		  	<li id="<?php echo $m['label'];?>"><a class="top"><?php echo ucfirst($m['label']);?></a>
			<ul>
		  	<?php foreach($m['subs'] as $item) { ?>
		  		<li><a href="index.php?route=<?php echo $m['label'];?>/<?php echo $item['item'];?>&token=<?php echo $token; ?>"><?php echo $item['label'];?></a></li>
		  	<?php } // END foreach $m['subs'] ?>
			</ul>
		  <?php } // END foreach $menu ?>
		  </li>
		  		
		</ul>
	
		<ul class="right">
			
			<li id="logout"><a href="index.php?route=common/logout&token=<?php echo $token; ?>" class="top">Uitloggen</a></li>
			
		</ul>
	
		<script type="text/javascript"><!--
	$(document).ready(function() {
		$('#menu > ul').superfish({
			hoverClass	 : 'sfHover',
			pathClass	 : 'overideThisToUse',
			delay		 : 0,
			animation	 : {height: 'show'},
			speed		 : 'normal',
			autoArrows   : false,
			dropShadows  : false, 
			disableHI	 : false, /* set to true to disable hoverIntent detection */
			onInit		 : function(){},
			onBeforeShow : function(){},
			onShow		 : function(){},
			onHide		 : function(){}
		});
		
		$('#menu > ul').css('display', 'block');
	});
	 
	function getURLVar(urlVarName) {
		var urlHalves = String(document.location).toLowerCase().split('?');
		var urlVarValue = '';
		
		if (urlHalves[1]) {
			var urlVars = urlHalves[1].split('&');
	
			for (var i = 0; i <= (urlVars.length); i++) {
				if (urlVars[i]) {
					var urlVarPair = urlVars[i].split('=');
					
					if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
						urlVarValue = urlVarPair[1];
					}
				}
			}
		}
		
		return urlVarValue;
	} 
	
	$(document).ready(function() {
		route = getURLVar('route');
		
		if (!route) {
			$('#dashboard').addClass('selected');
		} else {
			part = route.split('/');
			
			url = part[0];
			
			if (part[1]) {
				url += '/' + part[1];
			}
			
			$('a[href*=\'' + url + '\']').parents('li[id]').addClass('selected');
		}
	});
	//--></script> 
  </div>
  <?php } // END if $logged ?>
</div>
