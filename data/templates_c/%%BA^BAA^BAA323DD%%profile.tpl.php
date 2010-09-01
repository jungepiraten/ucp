<?php /* Smarty version 2.6.20, created on 2010-09-01 13:01:47
         compiled from profile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'profile.tpl', 13, false),)), $this); ?>
<table class="profile">
	<tr>
		<th>User:</th>
		<td><?php echo $this->_tpl_vars['user']; ?>
</td>
	</tr>
	<tr>
		<th>E-Mail:</th>
		<td>
			<?php $_from = $this->_tpl_vars['mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mail']):
?>
				<?php if ($this->_tpl_vars['mail'][1]): ?>
					<?php echo $this->_tpl_vars['mail'][0]; ?>

				<?php else: ?>
					<i><?php echo $this->_tpl_vars['mail'][0]; ?>
</i> <a href="?do=verify_mail&amp;mail=<?php echo ((is_array($_tmp=$this->_tpl_vars['mail'][0])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">[verifizieren]</a>
				<?php endif; ?>
				<?php if (count ( $this->_tpl_vars['mails'] ) > 1): ?>
					<a href="?do=delete_mail&amp;mail=<?php echo ((is_array($_tmp=$this->_tpl_vars['mail'][0])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">[l&ouml;schen]</a>
				<?php endif; ?>
				<br />
			<?php endforeach; endif; unset($_from); ?>
			<a href="?do=add_mail">[hinzuf&uuml;gen]</a>
		</td>
	</tr>
	<tr>
		<th>Passwort:</th>
		<td>********<br /><a href="?do=change_password">[&auml;ndern]</a></td>
	</tr>
</table>