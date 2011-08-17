/**
 * @file
 * Group SMS Manager
 * A system to control mass sign up and sending of SMS to a variety of services
 * https://github.com/guysoft/Group-SMS-Manager
 * J14Hackers group
 * 
 * @author: Eyal Ben Ivri <eyalbenivri at gmail.com>
 * @author: Ilan Arad <ilan at decodecode.net>
 * 
 */
function confirmDelete(user_id) {
	if(confirm("אתה בטוח שברצונך למחוק את המשתמש?\nפעולה זו לא יכולה להיות מבוטלת.")) {
		window.location = 'delete_user.php?user_id='+user_id;
	}
	return false;
}