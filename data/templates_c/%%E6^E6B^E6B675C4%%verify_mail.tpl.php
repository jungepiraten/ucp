<?php /* Smarty version 2.6.20, created on 2010-09-01 13:01:50
         compiled from verify_mail.tpl */ ?>
<p>Um Ihre E-Mail Adresse zu verifizieren, wird eine Mail an <?php echo $this->_tpl_vars['mail']; ?>
 geschickt, die einen Best&auml;tigungslink enth&auml;lt. Klicken Sie auf diesen Link, um die Verifizierung abzuschlie&szlig;en.</p>
<form action="?do=verify_mail" class="verify_mail" method="post">
	<input type="hidden" name="mail" value="<?php echo $this->_tpl_vars['mail']; ?>
" />
	<input class="submit" type="submit" name="send" value="Best&auml;tigungsmail senden" />
</form>