<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "//www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="//www.w3.org/1999/xhtml" xml:lang="de" dir="ltr">
	<head>
		<meta http-equiv="content-type" content="text/xhtml; charset=UTF-8" />
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
		<script type="text/javascript" src="data/jquery-1.7.1.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<title>{$title}</title>
		{literal}
		<style>
			body {
				margin-top:60px;
			}
		</style>
		{/literal}
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="brand" href="index.php">
						Junge Piraten UCP
					</a>
					<ul class="nav">
						<li><a href="https://forum.junge-piraten.de/index.php">Forenübersicht</a></li>
						<li class="active"><a href="index.php" >Mailinglisten</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Junge Piraten <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="https://www.junge-piraten.de/">Homepage</a></li>
								<li><a href="https://www.junge-piraten.de/mitmachen/">Mitmachen</a></li>
								<li><a href="index.php">Forum</a></li>
								<li><a href="https://wiki.junge-piraten.de/">Wiki</a></li>
								<li><a href="http://jupis.piratenpad.de/">Piratenpad</a></li>
								<li class="active"><a href="https://ucp.junge-piraten.de/">UCP</a></li>
								<li><a href="https://www.junge-piraten.de/presse">Presse</a></li>
							</ul>
						</li>
					</ul>

					{if $user}
						<span class="pull-right">angemeldet als<a href="index.php?module=profile">{$user}</a></span>
						<a href="logout.php" class="btn btn-danger pull-right"><i class="icon-off icon-white"></i> Abmelden</a>
					{else}
						<form class="navbar-form pull-right form-inline" action="index.php?module=login" method="POST">
							<input type="hidden" name="login" value="1" />
							<input type="text" name="username" class="span2" placeholder="Loginname" />
							<input type="password" name="password" class="span2" placeholder="Passwort" />
							<button type="submit" class="btn btn-primary">Anmelden</button>
						</form>
					{/if}
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row-fluid">
				<div class="span3">
					<div class="well sidebar-nav" style="padding: 8px 0;">
						<ul class="nav nav-list">
					{foreach key=mod item=mtitle from=$navigation name=navigation}
						{if $mod == $module}
							<li><a class="active" href="index.php?module={$mod}">{$mtitle}</a></li>
						{else} 
							<li><a href="index.php?module={$mod}">{$mtitle}</a></li>
						{/if}
					{/foreach}
						</ul>
					</div>
				</div>
				<div class="span9">
					<h1 style="margin-bottom: 20px;">{$pagetitle}</h1>
					{$content}
				</div>
			</div>
		</div>
	</body>
</html>
