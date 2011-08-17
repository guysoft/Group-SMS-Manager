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
$(document).ready(PageReady);

function PageReady() {
	$("#text").keyup(TextKeyUp);
	TextKeyUp();
}

function TextKeyUp() {
	var chars = $("#text").val().length;
	var chars_left = 70 - chars;
	$("#text_counter").text(chars_left);
	if(chars_left <= 5) $("#text_counter").addClass("closeTo");
	else $("#text_counter").removeClass("closeTo");
}

