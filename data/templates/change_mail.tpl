<p>Beachten Sie, dass bei einer &Auml;nderung der E-Mail Adresse eine erneute Verifizierung notwendig ist.</p>
<form action="?do=change_mail" class="change_mail" method="post">
	{if !empty($mail)}<input type="hidden" name="mail" value="{$mail}" />{/if}
	<table>
	<tr>
		<th>E-Mail:</th>
		<td><input type="text" name="newmail" value="{$mail}" /><td>
	</tr>
	{if !empty($mail)}
	<tr>
		<th>Mailinglisten umziehen?</th>
		<td><input type="checkbox" name="movelists" value="1" checked="checked" /></td>
	</tr>
	{/if}
	<tr>
		<td colspan="2"><input type="submit" name="act" value="{if !empty($mail)}&auml;ndern{else}hinzuf&uuml;gen{/if}" /></td>
	</tr>
	</table>
</form>
