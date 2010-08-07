<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" dir="ltr">
	<head>
		<meta http-equiv="content-type" content="text/xhtml; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="data/style.css" />
		<title>{$title}</title>
	</head>
	<body>
		<div id="maincontainer">
			<img src="data/images/logo-ucp.png" title="Junge Piraten UCP" alt="Junge Piraten UCP" />
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
			<a href="http://jupis.piratenpad.de/ucp-vorschlaege">Bitte hilf mit, das UCP zu verbessern!</a>
			<div id="content">
				{$content}
			</div>
		</div>
	</body>
</html>
