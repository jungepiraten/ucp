{if $errors|@count > 0}
<div style="margin-bottom: 10px;">
<b>Fehler:</b>
<ul>
	{foreach from=$errors item=error}
	<li>{$error}</li>
	{/foreach}
</ul>
</div>
{/if}
<form action="{$PHP_SELF}" method="post">
	<table class="register" cellpadding="8" cellspacing="0" border="0">
		<tr>
			<td>Nutzername:</td>
			<td><input type="text" name="user" /></td>
		</tr>
		<tr>
			<td>E-Mail Adresse:</td>
			<td><input type="text" name="mail" /></td>
		</tr>
		<tr>
			<td>Passwort:</td>
			<td><input type="password" name="pass" /></td>
		</tr>
		<tr>
			<td>Passwort wiederholen:</td>
			<td><input type="password" name="pass_repeat" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="register" value="registrieren" /></td>
		</tr>
	</table>
</form>
