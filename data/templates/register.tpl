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
<form action="{$PHP_SELF}" class="register" method="post">
	<table>
	<tr>
		<th>Nutzername:</th>
		<td><input type="text" name="user" /></td>
	</tr>
	<tr>
		<th>E-Mail Adresse:</th>
		<td><input type="text" name="mail" /></td>
	</tr>
	<tr>
		<th>Passwort:</th>
		<td><input type="password" name="pass" /></td>
	</tr>
	<tr>
		<th>Passwort wiederholen:</th>
		<td><input type="password" name="pass_repeat" /></td>
	</tr>
	<tr>
		<th>Captcha</th>
		<td>{$captcha}</td>
	</tr>
	<tr>
		<td colspan="2"><input class="submit" type="submit" name="register" value="registrieren" /></td>
	</tr>
	</table>
</form>
