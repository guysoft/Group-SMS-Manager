<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?=$title?> - המאבק</title>
	<link rel="stylesheet" href="style2.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/edit_user.js"></script>
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
			<form action="edit_user.php" method="post" id="user_form">
				<input type="hidden" name="user[id]" id="user_id" value="<?=$user['id']?>" />
				<div class="form_element_container">
					<label for="name">
						שם:
					</label>
					<input type="text" name="user[name]" id="name" value="<?=$user['name']?>" />
				</div>
				<div class="form_element_container">
					<label for="phone">
						טלפון:
					</label>
					<input type="text" name="user[phone]" id="phone" value="<?=$user['phone']?>" />
				</div>
				<div class="form_element_container">
					<div class="checkbox_container">
						<label for="smsSender">
							<input type="checkbox" name="user[smsSender]" id="smsSender" value="1" <?=($user['smsSender']==1 ? 'checked' : '')?> />
							  מורשה לשליחת הודעות
						</label>
					</div>
				</div>
				<div class="form_element_container">
				<?php foreach($lists as $id => $list) : ?>
					<div class="checkbox_container">
						<label for="list_id_<?=$id?>">
							<input type="checkbox" name="lists[<?=$id?>]" id="list_id_<?=$id?>" value="1" <?=(is_array($user['lists']) && in_array($id, $user['lists']) ? 'checked' : '')?> />
							 <?=$list['name']?>
						</label>
					</div>
				<?php endforeach; ?>		
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
