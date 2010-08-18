<p>Beachten Sie, dass bei einer &Auml;nderung der E-Mail Adresse eine erneute Verifizierung notwendig ist.</p>
<form action="?do=change_mail" method="post">
	<input type="hidden" name="oldmail" value="{$mail}" />
	<b>E-Mail:</b>
	<input type="text" name="mail" value="{$mail}" />
	<b>Mailinglisten umziehen?</b>
	<input type="checkbox" name="movelists" value="1" checked="checked" />
	<input type="submit" value="&auml;ndern" />
</form>
