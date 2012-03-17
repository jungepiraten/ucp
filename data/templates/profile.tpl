<table class="form-vertical">
	<div class="control-group">
		<label class="control-label">Benutzername</label>
		<div class="controls">
			{$user}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">E-Mail</label>
		<div class="controls">
			{foreach from=$mails item=mail}
				{if $mail[1]}
					{$mail[0]}
				{else}
					<i>{$mail[0]}</i> <a class="btn btn-mini" href="?do=verify_mail&amp;mail={$mail[0]|escape:url}">verifizieren</a>
				{/if}
				{if count($mails)>1}
					<a class="btn btn-mini" href="?do=delete_mail&amp;mail={$mail[0]|escape:url}">L&ouml;schen</a>
				{/if}
				<br />
			{/foreach}
			<a class="btn" href="?do=add_mail">Hinzuf&uuml;gen</a>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Passwort</label>
		<div class="controls">
			******** <a class="btn btn-mini" href="?do=change_password">&Auml;ndern</a>
		</div>
	</div>
</table>
