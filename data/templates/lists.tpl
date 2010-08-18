<form action="{$PHP_SELF}" method="post">
	<table class="mailinglists" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<th>Liste</th>
			<th>Beschreibung</th>
			<th>Abonniert</th>
		</tr>
	{foreach key=id item=list from=$lists name=mailinglists}
		<tr>
			<td>{$list[0]}</td>
			<td>{$list[1]}</td>
			<td>
				<input type="hidden" name="old[{$list[0]}]" value="{if $list[2]}1{else}0{/if}" />
				<input type="checkbox" name="new[{$list[0]}]" value="1" {if $list[2]}checked {/if}/>
			</td>	
		<tr>
	{/foreach}
	</table>
	<input type="submit" name="submit" value="&Auml;nderungen speichern" />
</form>
