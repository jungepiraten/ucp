<?php /* Smarty version 2.6.26, created on 2010-04-26 10:33:54
         compiled from register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'register.tpl', 1, false),)), $this); ?>
<?php if (count($this->_tpl_vars['errors']) > 0): ?>
<div style="margin-bottom: 10px;">
<b>Fehler:</b>
<ul>
	<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
	<li><?php echo $this->_tpl_vars['error']; ?>
</li>
	<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php endif; ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" method="post">
	<table class="register" cellpadding="8" cellspacing="0" border="0">
		<tr>
			<td>Nutzername:</td>
			<td><input type="text" name="user" /></td>
		</tr>
		<tr>
			<td>E-Mail Adresse:</td>
			<td><input type="text" name="mail" /></td>
		</tr>
		<tr>
			<td>Passwort:</td>
			<td><input type="password" name="pass" /></td>
		</tr>
		<tr>
			<td>Passwort wiederholen:</td>
			<td><input type="password" name="pass_repeat" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="register" value="registrieren" /></td>
		</tr>
	</table>
</form>