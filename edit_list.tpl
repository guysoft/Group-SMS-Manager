<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?=$title?> - המאבק</title>
	<link rel="stylesheet" href="style2.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/edit_list.js"></script>
</head>

<body>
	<div class="wrapper header">
		<div class="inner header">
			<?php include('header.tpl'); ?>
		</div>	
	</div>
	<div class="wrapper main">
		<div class="inner main">
			<h2 class="title"><?=$title?></h2>
			<h3 class="message"><?=$message?></h3>
			<form action="edit_list.php" method="post" id="user_form">
				<input type="hidden" name="list[id]" id="list_id" value="<?=$list['id']?>" />
				<div class="form_element_container">
					<label for="name">
						שם:
					</label>
					<input type="text" name="list[name]" id="name" value="<?=$list['name']?>" />
				</div>
				<div class="form_element_container">
					<input type="submit" class="button submit" value="שלח" />
				</div>
			</form>
		</div>	
	</div>
	<div class="wrapper footer">
		<div class="inner footer">
		</div>	
	</div>
</body>
</html>
