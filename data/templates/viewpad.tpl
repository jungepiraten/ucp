<div class="container-fluid no-padding">
<div class="row-fluid">
	<div class="btn-toolbar span6">
		<button class="btn" onclick="document.getElementById('pad').webkitRequestFullScreen();">Vollbild</button>
	</div>
	{if $showNickBox}
		<form action="{$PHP_SELF}" method="post" class="form-inline span6">
			<fieldset class="pull-right">
				<input type="hidden" name="do" value="showPad" />
				<input type="hidden" name="pad" value="{$pad|escape:url}" />
				<input type="text" name="nick" value="{$nick|escape:html}" />
				<input type="submit" class="btn btn-primary" value="Nick setzen" />
			</fieldset>
		</form>
	{/if}
</div>
</div>

<iframe src="{$padlink}" style="width:100%; height:500px;" id="pad"></iframe>
