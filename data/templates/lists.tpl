<form action="{$PHP_SELF}" class="form-horizontal" method="post">
	<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Liste</th>
			<th>Beschreibung</th>
			<th>Abonniert</th>
		</tr>
	</thead>
	<tbody>
	{foreach key=id item=list from=$lists name=mailinglists}
		<tr>
			<td><a href="mailto:{$list[1]}" class="sendaddress"><i class="icon-envelope"></i></a>
				&nbsp;<a href="{$list[3]}">{$list[0]}</a></td>
			<td class="listdesc">{$list[2]}</td>
			<td class="abo">
				<select name="mail[{$list[0]}]">
					<option value=""></option>
					{foreach from=$mails item=mail}
						<option{if in_array($mail,$list[5])} selected="selected"{/if}>{$mail}</option>
					{/foreach}
				</select>
			</td>	
		</tr>
	{/foreach}
	</tbody>
	</table>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary" name="save" value="1">&Auml;nderungen speichern</button>
	</div>
</form>
