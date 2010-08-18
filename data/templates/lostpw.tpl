<form action="{$PHP_SELF}" method="post">
	<input type="hidden" name="u" value="{$uid}" />
	<input type="hidden" name="h" value="{$hash}" />
	<input type="hidden" name="t" value="{$timestamp}" />
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
