<div class="alert alert-info">Um Ihre E-Mail Adresse zu verifizieren, wird eine Mail an <strong>{$mail}</strong>
 geschickt, die einen Best&auml;tigungslink enth&auml;lt. Klicken Sie auf diesen Link,
 um die Verifizierung abzuschlie&szlig;en.</div>
<form action="?do=verify_mail" method="post">
	<input type="hidden" name="mail" value="{$mail}" />
	<button type="submit" class="btn btn-primary" name="send" value="1">Best&auml;tigungsmail senden</button>
</form>
