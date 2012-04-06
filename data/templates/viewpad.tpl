<div class="btn-toolbar">
	<button class="btn" onclick="document.getElementById('pad').webkitRequestFullScreen();">Vollbild</button>
	<a class="btn" href="{$padlink}" target="_blank">In neuem Fenster öffnen</a>
</div>

<iframe src="{$padlink}" style="width:100%; height:500px; border:1px solid #ccc;" id="pad"></iframe>
