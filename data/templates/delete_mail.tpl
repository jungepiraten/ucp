<p>Mailadresse <strong>{$mail}</strong> von ihrem Konto l&ouml;schen?</p>
<form action="?do=delete_mail" class="delete_mail" method="post">
	<input type="hidden" name="mail" value="{$mail}" />
	<table>
	<tr>
		<th>Mailinglisten ...</th>
		<td>
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
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="act" value="l&ouml;schen" /></td>
	</tr>
	</table>
</form>
