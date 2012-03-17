<h2>Benutzername</h2>
{$user}

<h2>E-Mail</h2>
<table>
	{foreach from=$mails item=mail}
		<tr>
			<td>
				{if $mail[1]}
					{$mail[0]}
				{else}
					<i>{$mail[0]}</i> <a class="btn btn-mini" href="?do=verify_mail&amp;mail={$mail[0]|escape:url}">verifizieren</a>
				{/if}
			</td>
			<td>
				{if count($mails)>1}
					<a class="btn btn-mini btn-danger" href="?do=delete_mail&amp;mail={$mail[0]|escape:url}">L&ouml;schen</a>
				{/if}
			</td>
		</tr>
	{/foreach}
	<tr>
		<td>&nbsp;</td>
		<td><a class="btn btn-mini" href="?do=add_mail">Hinzuf&uuml;gen</a></td>
	</tr>
</table>

<h2>Passwort</h2>

******** <a class="btn btn-mini" href="?do=change_password">&Auml;ndern</a>
