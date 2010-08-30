<form action="{$PHP_SELF}" class="lists" method="post">
	<table>
	<thead>
	<tr>
		<th class="listname">Liste</th>
		<th class="listdesc">Beschreibung</th>
		<th class="abo">Abonniert</th>
	</tr>
	</thead>
	<tbody>
	{foreach key=id item=list from=$lists name=mailinglists}
	<tr class="{cycle values=odd,even}">
		<td class="listname">{$list[0]}</td>
		<td class="listdesc">{$list[1]}</td>
		<td class="abo">
			<select name="mail[{$list[0]}]">
				<option value=""></option>
				{foreach from=$mails item=mail}
					<option{if in_array($mail,$list[3])} selected="selected"{/if}>{$mail}</option>
				{/foreach}
			</select>
		</td>	
	<tr>
	{/foreach}
	</tbody>
	<tfoot>
	<tr>
		<td colspan="3"><input type="submit" name="save" value="&Auml;nderungen speichern" /></td>
	</tfoot>
	</table>
</form>
