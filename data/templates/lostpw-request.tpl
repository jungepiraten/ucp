<form action="{$PHP_SELF}" method="post" class="form-horizontal">
	<fieldset>
		<div class="control-group">
			<label for="user" class="control-label">Benutzername:</label>
			<p class="controls">
				<input type="text" class="username" name="user" />
			</p>
		</div>
		
		<div class="control-group">
			<label for="mail" class="control-label">E-Mail:</label>
			<p class="controls">
				<input type="text" class="mail" name="mail" id="mail"/>
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="lostpw-request" value="1">Anfordern</button>
		</div>
	</fieldset>
</form>