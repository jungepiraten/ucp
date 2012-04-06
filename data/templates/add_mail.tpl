{include file="header.tpl"}
<form action="?do=add_mail" method="post" class="form-horizontal">
	<fieldset>
		<div class="control-group">
			<label for="mail" class="control-label">E-Mail:</label>
			<p class="controls">
				<input type="text" class="mail" name="mail" />
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="act" value="1">hinzuf&uuml;gen</button>
		</div>
	</fieldset>
</form>
{include file="footer.tpl"}
