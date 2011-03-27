<?php /* Smarty version 2.6.26, created on 2011-03-28 01:30:29
         compiled from main.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "//www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="//www.w3.org/1999/xhtml" xml:lang="de" dir="ltr">
	<head>
		<meta http-equiv="content-type" content="text/xhtml; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="data/style.css" />
		<title><?php echo $this->_tpl_vars['title']; ?>
</title>
	</head>
	<body>
		<div id="maincontainer">
			<img src="data/images/logo-ucp.png" title="Junge Piraten UCP" alt="Junge Piraten UCP" />
			<div id="loggedin"><?php if ($this->_tpl_vars['user']): ?>Angemeldet als <?php echo $this->_tpl_vars['user']; ?>
<?php if ($this->_tpl_vars['user_override']): ?> - <a href="?module=logout">Override beenden</a><?php endif; ?><?php else: ?>Nicht angemeldet<?php endif; ?></div>
			<div id="navigation">
				<?php $_from = $this->_tpl_vars['navigation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['navigation'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['navigation']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['mod'] => $this->_tpl_vars['title']):
        $this->_foreach['navigation']['iteration']++;
?>
					<?php if ($this->_tpl_vars['mod'] == $this->_tpl_vars['module']): ?>
						<a class="active" href="index.php?module=<?php echo $this->_tpl_vars['mod']; ?>
"><?php echo $this->_tpl_vars['title']; ?>
</a>
					<?php else: ?> 
						<a href="index.php?module=<?php echo $this->_tpl_vars['mod']; ?>
"><?php echo $this->_tpl_vars['title']; ?>
</a>
					<?php endif; ?>
					<?php if (! ($this->_foreach['navigation']['iteration'] == $this->_foreach['navigation']['total'])): ?> - <?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			<a href="//jupis.piratenpad.de/ucp-vorschlaege">Bitte hilf mit, das UCP zu verbessern!</a>
			<div id="content">
				<?php echo $this->_tpl_vars['content']; ?>

			</div>
		</div>
	</body>
</html>