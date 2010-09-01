<p>Um Ihre E-Mail Adresse zu verifizieren, wird eine Mail an {$mail} geschickt, die einen Best&auml;tigungslink enth&auml;lt. Klicken Sie auf diesen Link, um die Verifizierung abzuschlie&szlig;en.</p>
<form action="?do=verify_mail" class="verify_mail" method="post">
	<input type="hidden" name="mail" value="{$mail}" />
	<input class="submit" type="submit" name="send" value="Best&auml;tigungsmail senden" />
</form>
