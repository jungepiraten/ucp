<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "//www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="//www.w3.org/1999/xhtml" xml:lang="de" dir="ltr">
	<head>
		<meta http-equiv="content-type" content="text/xhtml; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="data/style.css" />
		<title>{$title}</title>
	</head>
	<body>
		<div id="maincontainer">
			<img src="data/images/logo-ucp.png" title="Junge Piraten UCP" alt="Junge Piraten UCP" />
			<div id="loggedin">{if $user}Angemeldet als {$user}{if $user_override} - <a href="?module=logout">Override beenden</a>{/if}{else}Nicht angemeldet{/if}</div>
			<div id="navigation">
				{foreach key=mod item=title from=$navigation name=navigation}
					{if $mod == $module}
						<a class="active" href="index.php?module={$mod}">{$title}</a>
					{else} 
						<a href="index.php?module={$mod}">{$title}</a>
					{/if}
					{if not $smarty.foreach.navigation.last} - {/if}
				{/foreach}
			</div>
			<div id="content">
				{$content}
			</div>
		</div>
	</body>
</html>
