<?php /* Smarty version 2.6.20, created on 2010-08-18 07:11:17
         compiled from lostpw-request.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" method="post">
	<table class="lostpw" cellpadding="8" cellspacing="0" border="0">
		<tr>
			<td>User:</td>
			<td><input type="text" name="user" /></td>
		</tr>
		<tr>
			<td>Mail:</td>
			<td><input type="text" name="mail" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="anfordern" /></td>
		</tr>
	</table>
</form>