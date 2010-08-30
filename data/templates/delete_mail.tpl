<p>Mailadresse {$mail} von ihrem Konto l&ouml;schen?</p>
<form action="?do=delete_mail" class="delete_mail" method="post">
	<input type="hidden" name="mail" value="{$mail}" />
	<table>
	<tr>
		<th>Mailinglisten ...</th>
		<td>
		 <select name="listsoption">
		  <option value="delete">L&ouml;schen</option>
		  <option value="ignore">Beibehalten</option>
		 </select>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="act" value="l&ouml;schen" /></td>
	</tr>
	</table>
</form>
