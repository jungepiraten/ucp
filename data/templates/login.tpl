<form action="{$PHP_SELF}" method="post" class="form-horizontal">
	<fieldset>
		<div class="control-group">
			<label for="username" class="control-label">Benutzername:</label>
			<p class="controls">
				<input type="text" class="username" name="username" />
			</p>
		</div>
		
		<div class="control-group">
			<label for="password" class="control-label">Passwort:</label>
			<p class="controls">
				<input type="password" class="password" name="password" id="password"/>
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="login" value="1">Anmelden</button>
		</div>
	</fieldset>
</form>