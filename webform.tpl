<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?=$title?> - המאבק</title>
	<link rel="stylesheet" href="style2.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/webform.js"></script>
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
			<form action="index.php" method="post" id="sms_form">
				<div class="form_element_container">
					<label for="list_selector">
						בחר רשימה:
					</label>
					<select id="list_selector" name="sms[list_id]">
					<?php foreach($lists as $id => $name) : ?>
						<option value="<?=$id?>" <?=($id==$sms['list_id'] ? 'selected' : '')?>><?=$name?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="form_element_container">
					<label for="text">
						הודעה:
					</label>
					<textarea id="text" name="sms[text]"><?=$sms['text']?></textarea>
					<div>תוים שנשארו: <span id="text_counter"></div>
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
