<?php /* Smarty version 2.6.20, created on 2010-08-30 20:07:04
         compiled from login.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" class="login" method="post">
	<table>
	<tr>
		<th>User:</th>
		<td><input type="text" name="user" /></td>
	</tr>
	<tr>
		<th>Passwort:</th>
		<td><input type="password" name="pass" /></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="einloggen" /></td>
	</tr>
	</table>
</form>