<?php /* Smarty version 2.6.20, created on 2010-09-01 13:28:58
         compiled from lostpw.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" class="lostpw" method="post">
	<input type="hidden" name="v" value="<?php echo $this->_tpl_vars['v']; ?>
" />
	<table>
	<tr>
		<th>Neues Passwort:</th>
		<td><input type="password" name="pass" /></td>
	</tr>
	<tr>
		<th>Wiederholen:</th>
		<td><input type="password" name="pass_repeat" /></td>
	</tr>
	<tr>
		<td colspan="2"><input class="submit" type="submit" value="&auml;ndern" /></td>
	</tr>
	</table>
</form>