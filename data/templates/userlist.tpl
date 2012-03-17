<form action="{$PHP_SELF}" class="form-horizontal" method="post" id="form_userlist">
	<label for="filter"><strong>Filter:</strong></label> <input type="text" name="filter" value="{$smarty.request.filter|escape:html}" /> <input type="button" onClick="document.getElementById('value_do').value = ''; document.getElementById('form_userlist').submit();" value="Filtern" />
	<input type="hidden" name="do" id="value_do" value="" />
	<table class="table table-striped">
	<thead>
	<tr>
		<th class="bulk">&nbsp;</th>
		<th class="username">Benutzername</th>
		<th class="override">&Uuml;berschreiben</th>
		<th class="delete">L&ouml;schen</th>
	</tr>
	</thead>
	<tbody>
	{foreach from=$users item=user}
	<tr>
		<td class="bulk"><input type="checkbox" name="users[]" value="{$user|escape:url}" /></td>
		<td class="username">{$user|escape:html}</td>
		<td class="override"><a class="btn brn-mini" href="?do=override&amp;user={$user|escape:url}">&Uuml;berschreiben</a></td>
		<td class="delete"><a class="btn btn-mini btn-error" href="?do=delete&amp;users[]={$user|escape:url}" onClick="return confirm('Sicher?');">L&ouml;schen</a></td>
	<tr>
	{/foreach}
	</tbody>
	</table>

	<div class="form-actions">
		<button class="btn" onClick="document.getElementById('value_do').value = 'delete'; document.getElementById('form_userlist').submit();">L&ouml;schen</button>
	</div>
</form>
