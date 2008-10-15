<?php include( helper("navigation") ) ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php echo meta_tag("keywords", "Keywords, Keywords") ?>
	<?php echo meta_tag("description", "Description") ?>
	
	<?php echo title_tag() ?>
	
	<?php echo stylesheet_tag("global.css") ?>
	<?php echo stylesheet_tag("form.css") ?>
	<?php echo stylesheet_tag("default/theme.css") ?>

	<?php echo javascript_tag("jquery-1.2.6.pack.js") ?>
	<?php echo javascript_tag("application.js") ?>
</head>
<body>
	<div id="container">
		<div id="navigation" class="clear" style="display:none">
			<ul>
				<?php echo navigation_item( a_tag("user/terms", "Enter Contest"), 0) ?>
			</ul>
		</div>
		
		<?php if ( admin() ) { ?>
		<div id="admin-navigation" class="clear">
			<ul>
				<?php echo navigation_item( a_tag("admin/title/create", "New Comic Title"), ACCESS_ADMIN) ?>
				<?php echo navigation_item( a_tag("admin/subscription/view", "View Subscriptions"), ACCESS_ADMIN) ?>
				<?php echo navigation_item( a_tag("announcement/create", "New Announcement"), ACCESS_ADMIN) ?>
			</ul>
		</div>
		<?php } ?>
		
		<?php echo messages_tag() ?>
		
		<div id="body">