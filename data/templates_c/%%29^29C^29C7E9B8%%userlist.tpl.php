<?php /* Smarty version 2.6.20, created on 2010-10-21 20:52:13
         compiled from userlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'userlist.tpl', 13, false),array('modifier', 'escape', 'userlist.tpl', 14, false),)), $this); ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" class="userlist" method="post" id="form_userlist">
	<input type="hidden" name="do" id="value_do" value="" />
	<table class="userlist">
	<thead>
	<tr>
		<th class="bulk">&nbsp;</th>
		<th class="username">Benutzername</th>
		<th class="delete">L&ouml;schen</th>
	</tr>
	</thead>
	<tbody>
	<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "odd,even"), $this);?>
">
		<td class="bulk"><input type="checkbox" name="users[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" /></td>
		<td class="username"><?php echo ((is_array($_tmp=$this->_tpl_vars['user'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
		<td class="delete"><a href="?do=delete&amp;users[]=<?php echo ((is_array($_tmp=$this->_tpl_vars['user'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" onClick="return confirm('Sicher?');">L&ouml;schen</a></td>
	<tr>
	<?php endforeach; endif; unset($_from); ?>
	</tbody>
	<tfoot>
		<td colspan="3">
			<input type="button" onClick="document.getElementById('value_do').value = 'delete'; document.getElementById('form_userlist').submit();" value="L&ouml;schen" />
		</td>
	</tfoot>
	</table>
</form>