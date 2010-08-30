<?php /* Smarty version 2.6.20, created on 2010-08-30 20:07:06
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
" class="register" method="post">
	<table>
	<tr>
		<th>Nutzername:</th>
		<td><input type="text" name="user" /></td>
	</tr>
	<tr>
		<th>E-Mail Adresse:</th>
		<td><input type="text" name="mail" /></td>
	</tr>
	<tr>
		<th>Passwort:</th>
		<td><input type="password" name="pass" /></td>
	</tr>
	<tr>
		<th>Passwort wiederholen:</th>
		<td><input type="password" name="pass_repeat" /></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="register" value="registrieren" /></td>
	</tr>
	</table>
</form>