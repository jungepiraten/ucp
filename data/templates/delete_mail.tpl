<p>Mailadresse {$mail} von ihrem Konto l&ouml;schen?</p>
<form action="?do=delete_mail" method="post">
	<input type="hidden" name="mail" value="{$mail}" />
	<b>Mailinglisten ...</b>
	<input type="radio" name="listsoption" value="delete" /> L&ouml;schen
	<input type="radio" name="listsoption" value="ignore" /> Beibehalten<br />
	<input type="submit" name="act" value="l&ouml;schen" />
</form>
