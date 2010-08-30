<form action="{$PHP_SELF}" class="lostpw" method="post">
	<input type="hidden" name="u" value="{$uid}" />
	<input type="hidden" name="h" value="{$hash}" />
	<input type="hidden" name="t" value="{$timestamp}" />
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
		<td colspan="2"><input type="submit" value="&auml;ndern" /></td>
	</tr>
	</table>
</form>
