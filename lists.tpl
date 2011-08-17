<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?=$title?> - המאבק</title>
	<link rel="stylesheet" href="style2.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/lists.js"></script>
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
			<a href="edit_list.php">קבוצה חדשה</a>
			<table cellpadding="0" cellspacing="0" width="80%">
				<tr>
					<th>עריכה</th>
					<th>שם</th>
					<th>מחיקה</th>
				</tr>
			<?php foreach($lists as $id => $list) : ?>
				<tr>
					<td><a href="edit_list.php?list_id=<?=$list['id']?>">עריכה</a></td>
					<td><?=$list['name']?></td>
					<td><a href="#<?=$list['id']?>" onclick="return confirmDelete(<?=$list['id']?>);">מחיקה</a></td>
				</tr>
			<?php endforeach;?>
			</table>
		</div>	
	</div>
	<div class="wrapper footer">
		<div class="inner footer">
		</div>	
	</div>
</body>
</html>
