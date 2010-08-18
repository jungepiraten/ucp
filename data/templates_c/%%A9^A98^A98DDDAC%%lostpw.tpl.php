<?php /* Smarty version 2.6.20, created on 2010-08-18 07:11:48
         compiled from lostpw.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" method="post">
	<input type="hidden" name="u" value="<?php echo $this->_tpl_vars['uid']; ?>
" />
	<input type="hidden" name="h" value="<?php echo $this->_tpl_vars['hash']; ?>
" />
	<input type="hidden" name="t" value="<?php echo $this->_tpl_vars['timestamp']; ?>
" />
	<table class="lostpw" cellpadding="8" cellspacing="0" border="0">
		<tr>
			<td>Neues Passwort:</td>
			<td><input type="password" name="pass" /></td>
		</tr>
		<tr>
			<td>Wiederholen:</td>
			<td><input type="password" name="pass_repeat" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="&auml;ndern" /></td>
		</tr>
	</table>
</form>