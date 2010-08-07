<?php /* Smarty version 2.6.26, created on 2010-05-15 01:11:13
         compiled from verify_mail.tpl */ ?>
<form action="?do=verify" method="post">
	<p>Um Ihre E-Mail Adresse zu verifizieren, wird eine Mail an <?php echo $this->_tpl_vars['mail']; ?>
 geschickt, die einen Best&auml;tigungslink enth&auml;lt. Klicken Sie auf diesen Link, um die Verifizierung abzuschlie&szlig;en.</p>
	<input type="submit" name="send" value="Best&auml;tigungsmail senden" />
</form>