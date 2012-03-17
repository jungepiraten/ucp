<form action="{$PHP_SELF}" class="form-inline" method="post">
	<input type="text" name="filter" value="{$smarty.request.filter|escape:html}" placeholder="Filtern ..." />
	<input class="btn btn-primary" type="submit" value="Filtern" />
</form>
<form action="{$PHP_SELF}" class="form-horizontal" method="post" id="form_userlist">
	<table class="table table-striped">
	<thead>
	<tr>
		<th class="bulk">&nbsp;</th>
		<th class="username">Benutzername</th>
		<th class="override">&Uuml;berschreiben</th>
		<th class="delete">L&ouml;schen</th>
	</tr>
	</thead>
	{foreach from=$users item=user}
	<tr>
		<td class="bulk"><input type="checkbox" name="users[]" value="{$user|escape:url}" /></td>
		<td class="username">{$user|escape:html}</td>
		<td class="override"><a class="btn btn-mini" href="?do=override&amp;user={$user|escape:url}">&Uuml;berschreiben</a></td>
		<td class="delete"><a class="btn btn-mini btn-danger" href="?do=delete&amp;users[]={$user|escape:url}" onClick="return confirm('Sicher?');">L&ouml;schen</a></td>
	<tr>
	{/foreach}
	</table>

	<div class="form-actions">
		<button class="btn btn-danger" type="submit" name="do" value="delete">L&ouml;schen</button>
	</div>
</form>
