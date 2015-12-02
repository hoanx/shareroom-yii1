<?php
class SmtpMailer extends JPhpMailer {
	var $Host = 'shareroom.vn';
	var $SMTPSecure = '';
	var $Username = 'support@shareroom.vn';
	var $Port = '143';
	var $Password = '1qaZXsw2';
	var $Mailer =  'smtp';
	var $CharSet = 'utf-8';
	var $SMTPAuth = true;
	var $SMTPKeepAlive = true;
}