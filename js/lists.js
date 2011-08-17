/**
 * @file
 * Group SMS Manager
 * A system to control mass sign up and sending of SMS to a variety of services
 * https://github.com/guysoft/Group-SMS-Manager
 * J14Hackers group
 * 
 * @author: Eyal Ben Ivri <eyalbenivri at gmail.com>
 * 
 */
function confirmDelete(list_id) {
	if(confirm("אתה בטוח שברצונך למחוק את הקבוצה?\nפעולה זו לא יכולה להיות מבוטלת.")) {
		window.location = 'delete_list.php?list_id='+list_id;
	}
	return false;
}