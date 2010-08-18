<p>Beachten Sie, dass bei einer &Auml;nderung der E-Mail Adresse eine erneute Verifizierung notwendig ist.</p>
<form action="?do=change_mail" method="post">
	<b>E-Mail:</b>
	<input type="text" name="newmail" value="{$mail}" /><br />
	{if !empty($mail)}
	<input type="hidden" name="mail" value="{$mail}" />
	<b>Mailinglisten umziehen?</b>
	<input type="checkbox" name="movelists" value="1" checked="checked" /><br />
	{/if}
	<input type="submit" name="act" value="{if !empty($mail)}&auml;ndern{else}hinzuf&uuml;gen{/if}" />
</form>
