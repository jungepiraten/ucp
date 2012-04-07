{include file="header.tpl"}
<div class="alert">Mailadresse <strong>{$mail}</strong> von ihrem Konto l&ouml;schen?</div>
{if $mailnotinuse}
	<p>Die Mailadresse wird derzeit nicht benutzt.</p>
{/if}
{if $mailnotverified}
	<p>Kann nicht zu dieser Mailadresse verschieben: Sie ist nicht verifiziert.</p>
{/if}
{if $sourceequalsdestination}
	<p>Witzbold ;)</p>
{/if}
{if $success}
	<p>Die E-Mail Adresse wurde erfolgreich gel&ouml;scht.</p>
{/if}

<form action="?do=delete_mail" method="post" class="form-horizontal">
	<fieldset>
		<input type="hidden" name="mail" value="{$mail}" />
		<div class="control-group">
			<label for="mail" class="control-label">Mailinglisten:</label>
			<p class="controls">
				{literal}<select name="listsoption" onchange="if (this.value=='move') {document.getElementsByName('movemail')[0].style.display='inline';} else {document.getElementsByName('movemail')[0].style.display='none';}">{/literal}
					<option value="delete">L&ouml;schen</option>
					<option value="ignore">Beibehalten</option>
					<option value="move" selected="selected">Verschieben:</option>
				</select>
				<select name="movemail">
					{foreach from=$mails item=movemail}
						{if $movemail != $mail}
							<option>{$movemail}</option>
						{/if}
					{/foreach}
				</select>
				{literal}<script type="text/javascript">document.getElementsByName('listsoption')[0].onchange();</script>{/literal}
			</p>
		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="act" value="1">l&ouml;schen</button>
		</div>
	</fieldset>
</form>
{include file="footer.tpl"}

