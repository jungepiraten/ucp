<?php /* Smarty version 2.6.20, created on 2010-08-18 03:12:26
         compiled from verify_mail.tpl */ ?>
<form action="?do=verify" method="post">
	<p>Um Ihre E-Mail Adresse zu verifizieren, wird eine Mail an <?php echo $this->_tpl_vars['mail']; ?>
 geschickt, die einen Best&auml;tigungslink enth&auml;lt. Klicken Sie auf diesen Link, um die Verifizierung abzuschlie&szlig;en.</p>
	<input type="hidden" name="mail" value="<?php echo $this->_tpl_vars['mail']; ?>
" />
	<input type="submit" name="send" value="Best&auml;tigungsmail senden" />
</form>