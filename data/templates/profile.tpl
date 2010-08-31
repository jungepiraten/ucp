<table class="profile">
	<tr>
		<th>User:</th>
		<td>{$user}</td>
	</tr>
	<tr>
		<th>E-Mail:</th>
		<td>
			{foreach from=$mails item=mail}
				{if $mail[1]}
					{$mail[0]}
				{else}
					<i>{$mail[0]}</i> <a href="?do=verify&amp;mail={$mail[0]|escape:url}">[verifizieren]</a>
				{/if}
				{if count($mails)>1}
					<a href="?do=delete_mail&amp;mail={$mail[0]|escape:url}">[l&ouml;schen]</a>
				{/if}
				<br />
			{/foreach}
			<a href="?do=add_mail">[hinzuf&uuml;gen]</a>
		</td>
	</tr>
	<tr>
		<th>Passwort:</th>
		<td>********<br /><a href="?do=change_password">[&auml;ndern]</a></td>
	</tr>
</table>
