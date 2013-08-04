{include file="header.tpl"}
{if $loginfailed}
	<p class="error">Login fehlgeschlagen!</p>
{/if}

<form action="{$PHP_SELF}" method="post" class="form-horizontal">
	<fieldset>
		<div class="control-group">
			<label for="user" class="control-label">Benutzer*innenname:</label>
			<p class="controls">
				<input type="text" name="user" />
			</p>
		</div>
		
		<div class="control-group">
			<label for="pass" class="control-label">Passwort:</label>
			<p class="controls">
				<input type="password" name="pass"/>
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="login" value="1">Anmelden</button>
		</div>
	</fieldset>
</form>
{include file="footer.tpl"}

