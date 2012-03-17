<form action="?do=change_password" class="change_password" method="post">
	<table>
	<tr>
		<th>Altes Passwort:</th>
		<td><input type="password" name="old_pass" /></td>
	</tr>
	<tr>
		<th>Neues Passwort:</th>
		<td><input type="password" name="pass" /></td>
	</tr>
	<tr>
		<th>Passwort wiederholen:</th>
		<td><input type="password" name="pass_repeat" /></td>
	</tr>
	<tr>
		<td colspan="2"><input class="submit" type="submit" value="&auml;ndern" /></td>
	</tr>
	</table>
</form>
<form action="?do=add_mail" method="post" class="form-horizontal">
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
				<input type="text" name="pass" />
			</p>
		</div>

		<div class="control-group">
			<label for="pass_repeat" class="control-label">Passwort wiederholen:</label>
			<p class="controls">
				<input type="text" name="pass_repeat" />
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="aendern" value="1">&auml;ndern</button>
		</div>
	</fieldset>
</form>