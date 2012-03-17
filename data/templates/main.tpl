<!DOCTYPE html>
<html dir="ltr">
	<head>
		<meta http-equiv="content-type" content="text/xhtml; charset=UTF-8" />
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<style type="text/css">
		{literal}
                        body {
                                padding-top: 60px;
                                padding-bottom: 40px;
                        }
        
                        .no-padding {
                                padding:0px;
                        }

                        .no-top-bottom-margin {
                                margin-top:0px;
                                margin-bottom:0px;
                        }
		{/literal}
		</style>

                <!--[if lt IE 9]>
                        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <![endif]-->

                <title>Junge Piraten &bull; {$title|escape:html}</title>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="brand" href="index.php">
						Junge Piraten
					</a>
					<ul class="nav">
						<li class="active"><a href="index.php">Account</a></li>
						<li><a href="https://forum.junge-piraten.de/index.php">Forum</a></li>
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

					{if !isset($user)}
						<form class="navbar-form pull-right form-inline" action="index.php?module=login" method="POST">
							<input type="hidden" name="login" value="1" />
							<input type="text" name="username" class="span2" placeholder="Loginname" />
							<input type="password" name="password" class="span2" placeholder="Passwort" />
							<button type="submit" class="btn btn-primary">Anmelden</button>
						</form>
					{else}
						<a href="index.php?module=logout" class="btn btn-danger pull-right"><i class="icon-off icon-white"></i> Abmelden</a>
					{/if}
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span3 hidden-phone">
					<div class="well sidebar-nav" style="padding: 8px 0;">
						<ul class="nav nav-list">
							{foreach key=mod item=mtitle from=$navigation name=navigation}
								<li {if $mod == $module}class="active"{/if}><a href="index.php?module={$mod}"><i class="{if $mod == "login"}icon-user{elseif $mod == "lostpw"}icon-lock{elseif $mod == "register"}icon-cog{elseif $mod == "home"}icon-home{elseif $mod == "profile"}icon-user{elseif $mod == "lists"}icon-list-alt{elseif $mod == "console"}icon-lock{elseif $mod == "logout"}icon-off{/if} {if $mod == $module}icon-white{/if}"></i> {$mtitle|escape:html}</a></li>
							{/foreach}
						</ul>
					</div>
				</div>

				<div class="span9">
					<h1 style="margin-bottom: 20px;">{$title|escape:html}</h1>
					{$content}
				</div>
			</div>
		</div>

		<hr />

		<footer>
			Erstellt f&uuml;r die <a href="//www.junge-piraten.de/">Jungen Piraten</a>.
		</footer>
	</body>
</html>
