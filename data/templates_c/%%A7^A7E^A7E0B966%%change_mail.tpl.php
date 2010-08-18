<?php /* Smarty version 2.6.20, created on 2010-08-18 04:02:45
         compiled from change_mail.tpl */ ?>
<p>Beachten Sie, dass bei einer &Auml;nderung der E-Mail Adresse eine erneute Verifizierung notwendig ist.</p>
<form action="?do=change_mail" method="post">
	<b>E-Mail:</b>
	<input type="text" name="newmail" value="<?php echo $this->_tpl_vars['mail']; ?>
" /><br />
	<?php if (! empty ( $this->_tpl_vars['mail'] )): ?>
	<input type="hidden" name="mail" value="<?php echo $this->_tpl_vars['mail']; ?>
" />
	<b>Mailinglisten umziehen?</b>
	<input type="checkbox" name="movelists" value="1" checked="checked" /><br />
	<?php endif; ?>
	<input type="submit" name="act" value="<?php if (! empty ( $this->_tpl_vars['mail'] )): ?>&auml;ndern<?php else: ?>hinzuf&uuml;gen<?php endif; ?>" />
</form>