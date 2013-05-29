{include file="header.tpl"}
<form action="?do=change_password" class="form-horizontal" method="post">
	<fieldset>
		<div class="control-group">
			<label for="old_pass" class="control-label">Altes Passwort:</label>
			<p class="controls">
				<input type="password" name="old_pass" />
			</p>
		</div>

		<div class="control-group">
			<label for="pass" class="control-label">Neues Passwort:</label>
			<p class="controls">
				<input type="password" name="pass" />
			</p>
		</div>

		<div class="control-group">
			<label for="pass_repeat" class="control-label">Passwort wiederholen:</label>
			<p class="controls">
				<input type="password" name="pass_repeat" />
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="aendern" value="1">&auml;ndern</button>
		</div>
	</fieldset>
</form>
{include file="footer.tpl"}
