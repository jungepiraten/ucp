<?php /* Smarty version 2.6.26, created on 2010-05-15 19:18:08
         compiled from change_mail.tpl */ ?>
<p>Beachten Sie, dass bei einer &Auml;nderung der E-Mail Adresse eine erneute Verifizierung notwendig ist. Auch werden die Mailinglisten f&uuml;r die alte E-Mail Adresse nicht abbestellt. Sie sollten daher, falsch gew&uuml;nscht, vor &Auml;nderung der E-Mail Adresse die abonnierten Mailinglisten abbestellen.</p>
<form action="?do=change_mail" method="post">
	<b>E-Mail:</b>
	<input type="text" name="mail" value="<?php echo $this->_tpl_vars['mail']; ?>
" />
	<input type="submit" value="&auml;ndern" />
</form>