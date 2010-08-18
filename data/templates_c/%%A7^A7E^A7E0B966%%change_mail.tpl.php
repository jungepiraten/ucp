<?php /* Smarty version 2.6.20, created on 2010-08-18 03:11:58
         compiled from change_mail.tpl */ ?>
<p>Beachten Sie, dass bei einer &Auml;nderung der E-Mail Adresse eine erneute Verifizierung notwendig ist.</p>
<form action="?do=change_mail" method="post">
	<input type="hidden" name="mail" value="<?php echo $this->_tpl_vars['mail']; ?>
" />
	<b>E-Mail:</b>
	<input type="text" name="newmail" value="<?php echo $this->_tpl_vars['mail']; ?>
" />
	<b>Mailinglisten umziehen?</b>
	<input type="checkbox" name="movelists" value="1" checked="checked" />
	<input type="submit" value="&auml;ndern" />
</form>