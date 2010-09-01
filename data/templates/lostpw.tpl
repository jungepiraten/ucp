<form action="{$PHP_SELF}" class="lostpw" method="post">
	<input type="hidden" name="v" value="{$v}" />
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
