<?php /* Smarty version 2.6.20, created on 2010-08-30 20:13:41
         compiled from lists.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'lists.tpl', 12, false),)), $this); ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" class="lists" method="post">
	<table>
	<thead>
	<tr>
		<th class="listname">Liste</th>
		<th class="listdesc">Beschreibung</th>
		<th class="abo">Abonniert</th>
	</tr>
	</thead>
	<tbody>
	<?php $_from = $this->_tpl_vars['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mailinglists'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mailinglists']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['list']):
        $this->_foreach['mailinglists']['iteration']++;
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "odd,even"), $this);?>
">
		<td class="listname"><?php echo $this->_tpl_vars['list'][0]; ?>
</td>
		<td class="listdesc"><?php echo $this->_tpl_vars['list'][1]; ?>
</td>
		<td class="abo">
			<select name="mail[<?php echo $this->_tpl_vars['list'][0]; ?>
]">
				<option value=""></option>
				<?php $_from = $this->_tpl_vars['mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mail']):
?>
					<option<?php if (in_array ( $this->_tpl_vars['mail'] , $this->_tpl_vars['list'][3] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['mail']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>	
	<tr>
	<?php endforeach; endif; unset($_from); ?>
	</tbody>
	<tfoot>
	<tr>
		<td colspan="3"><input type="submit" name="save" value="&Auml;nderungen speichern" /></td>
	</tfoot>
	</table>
</form>