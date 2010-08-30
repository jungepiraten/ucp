<?php /* Smarty version 2.6.20, created on 2010-08-30 20:04:26
         compiled from change_mail.tpl */ ?>
<p>Beachten Sie, dass bei einer &Auml;nderung der E-Mail Adresse eine erneute Verifizierung notwendig ist.</p>
<form action="?do=change_mail" class="change_mail" method="post">
	<?php if (! empty ( $this->_tpl_vars['mail'] )): ?><input type="hidden" name="mail" value="<?php echo $this->_tpl_vars['mail']; ?>
" /><?php endif; ?>
	<table>
	<tr>
		<th>E-Mail:</th>
		<td><input type="text" name="newmail" value="<?php echo $this->_tpl_vars['mail']; ?>
" /><td>
	</tr>
	<?php if (! empty ( $this->_tpl_vars['mail'] )): ?>
	<tr>
		<th>Mailinglisten umziehen?</th>
		<td><input type="checkbox" name="movelists" value="1" checked="checked" /></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="2"><input type="submit" name="act" value="<?php if (! empty ( $this->_tpl_vars['mail'] )): ?>&auml;ndern<?php else: ?>hinzuf&uuml;gen<?php endif; ?>" /></td>
	</tr>
	</table>
</form>