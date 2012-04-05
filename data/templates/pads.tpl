<form action="{$PHP_SELF}" method="post" class="form-inline">
	<fieldset>
		<input type="hidden" name="do" value="createPad" />
		<input type="text" name="pad" />
		<input type="submit" class="btn btn-primary" value="Pad anlegen" />
	</fieldset>
</form>
<table class="table table-striped table-bordered">
<thead>
	<tr>
		<th>&nbsp;</th>
		<th>Pad</th>
		{if $showPadOptions}
			<th>&nbsp;</th>
		{/if}
	</tr>
</thead>
<tbody>
{foreach item=pad from=$pads}
	<tr>
		<td>
			{if $pad.isPublic}
				{if $showPadOptions}<a href="?do=setPublic&pad={$pad.pad|escape:url}&public=0">{/if}
				<i class="icon-eye-open"></i>
				{if $showPadOptions}</a>{/if}
			{else}
				{if $showPadOptions}<a href="?do=setPublic&pad={$pad.pad|escape:url}&public=1">{/if}
				<i class="icon-eye-close"></i>
				{if $showPadOptions}</a>{/if}
			{/if}
			{if $pad.isProtected}<i class="icon-lock"></i>{/if}
		</td>
		<td><a href="?do=showPad&pad={$pad.pad|escape:url}">{$pad.pad|escape:html}</a></td>
		{if $showPadOptions}
			<td>
				<a href="?do=setPassword" onclick="$('#setPasswordModal input[name=pad]').val('{$pad.pad}'); $('#setPasswordModal').modal(); return false;" class="btn btn-mini">Passwort setzen</a>
			</td>
		{/if}
	</tr>
{/foreach}
</tbody>
</table>

<div class="modal" id="setPasswordModal" style="display:none;">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Passwort setzen</h3>
		</div>
		<form action="{$PHPSELF}" method="post" class="form-horizontal modal-body">
			<input type="hidden" name="do" value="setPassword" />
			<input type="hidden" name="pad" value="" />

			<div class="control-group">
				<label for="password" class="control-label">Passwort:</label>
				<p class="controls">
					<input type="text" name="password" />
				</p>
			</div>
		</form>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<button onclick="$(this).parent().parent().find('form').submit()" class="btn btn-primary">Passwort setzen</button>
		</div>
</div>
