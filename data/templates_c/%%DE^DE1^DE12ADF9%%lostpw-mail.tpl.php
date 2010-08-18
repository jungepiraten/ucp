<?php /* Smarty version 2.6.20, created on 2010-08-18 06:55:54
         compiled from lostpw-mail.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" method="post">
	<table class="lostpw" cellpadding="8" cellspacing="0" border="0">
		<tr>
			<td>User:</td>
			<td><input type="hidden" name="user" value="<?php echo $this->_tpl_vars['user']; ?>
" /><?php echo $this->_tpl_vars['user']; ?>
</td>
		</tr>
		<tr>
			<td>Mail:</td>
			<td><select name="mail"><?php $_from = $this->_tpl_vars['mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mail']):
?><option><?php echo $this->_tpl_vars['mail']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="anfordern" /></td>
		</tr>
	</table>
</form>