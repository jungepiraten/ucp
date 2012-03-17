{if $errors|@count > 0}
	{foreach from=$errors item=error}
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">×</a>
		<strong>Fehler!</strong> {$error}
	</div>
	{/foreach}
{/if}
<form action="?do=add_mail" method="post" class="form-horizontal">
	<fieldset>
		<div class="control-group">
			<label for="user" class="control-label">Nutzername:</label>
			<p class="controls">
				<input type="text" name="user" />
			</p>
		</div>

		<div class="control-group">
			<label for="mail" class="control-label">E-Mail:</label>
			<p class="controls">
				<input type="text" name="mail" />
			</p>
		</div>

		<div class="control-group">
			<label for="pass" class="control-label">Passwort:</label>
			<p class="controls">
				<input type="password" name="pass" />
			</p>
		</div>

		<div class="control-group">
			<label for="pass_repeat" class="control-label">Passwort wiederholen:</label>
			<p class="controls">
				<input type="text" name="pass_repeat" />
			</p>
		</div>

		<div class="control-group">
			<label for="captcha" class="control-label">Captcha:</label>
			<p class="controls">
				{$captcha}
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="register" value="1">registrieren</button>
		</div>
	</fieldset>
</form>