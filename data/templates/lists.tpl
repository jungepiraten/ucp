{literal}
<script type="text/javascript">
<!--

function unfold(id) {
	document.getElementById('ml' + id + '-fold').style.display = 'none';
	document.getElementById('ml' + id + '-unfold').style.display = 'block';
}

function fold(id) {
	document.getElementById('ml' + id + '-fold').style.display = 'block';
	document.getElementById('ml' + id + '-unfold').style.display = 'none';
}

//-->
</script>
{/literal}
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
				<!-- <input type="checkbox" name="new[{$list[0]}]" value="1" {if $list[2]}checked {/if}/> -->
				<select name="mail[{$list[0]}]">
					<option value=""></option>
					{foreach from=$mails item=mail}
						<option{if in_array($mail,$list[3])} selected="selected"{/if}>{$mail}</option>
					{/foreach}
				</select>
			</td>	
		<tr>
	{/foreach}
	</table>

<!--
	{foreach key=id item=list from=$lists name=mailinglists}
		<div id="ml{$id}-fold" style="display:none;">
			<a href="javascript:" onClick="unfold('{$id}');" class="listname">
				<img src="data/images/unfold.png" class="fold" />
				{$list[0]}
				{if $list[2]}<img src="data/images/active.png" alt="[x]" class="active" />{/if}
			</a>
			<span class="listdesc">{$list[1]}</span>
		</div>
		<div id="ml{$id}-unfold">
			<a href="javascript:" onClick="fold('{$id}');" class="listname">
				<img src="data/images/fold.png" class="fold" />
				{$list[0]}
				{if $list[2]}<img src="data/images/active.png" alt="[x]" class="active" />{/if}
			</a>
			<span class="listdesc">{$list[1]}</span>
			<div class="mails">
				{foreach from=$mails item=mail}
					<input type="hidden" name="old[{$mail}][{$list[0]}]" value="{if in_array($mail,$list[3])}1{else}0{/if}" />
					<input type="checkbox" name="new[{$mail}][{$list[0]}]" value="1" {if in_array($mail,$list[3])}checked="checked" {/if}/>
					{$mail}<br />
				{/foreach}
			</div>
		</div>
	{/foreach}
{foreach key=id item=list from=$lists name=mailinglists}
<script type="text/javascript">
{if $list[2]}
unfold('{$id}');
{else}
fold('{$id}');
{/if}
</script>
{/foreach}
-->
	<input type="submit" name="save" value="&Auml;nderungen speichern" />
</form>
