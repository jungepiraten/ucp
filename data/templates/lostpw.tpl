<form action="{$PHP_SELF}" method="post" class="form-horizontal">
	<fieldset>
		<div class="control-group">
			<label for="password" class="control-label">Neues Passwort:</label>
			<p class="controls">
				<input type="password" class="username" name="password" />
			</p>
		</div>
		
		<div class="control-group">
			<label for="pass_repeat" class="control-label">Wiederholen:</label>
			<p class="controls">
				<input type="password" name="pass_repeat" />
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="lostpw" value="1">Ändern</button>
		</div>
	</fieldset>
</form>