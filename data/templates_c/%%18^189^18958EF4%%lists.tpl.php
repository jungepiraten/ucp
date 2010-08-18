<?php /* Smarty version 2.6.20, created on 2010-08-18 04:22:32
         compiled from lists.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" method="post">
	<table class="mailinglists" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<th>Liste</th>
			<th>Beschreibung</th>
			<th>Abonniert</th>
		</tr>
	<?php $_from = $this->_tpl_vars['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mailinglists'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mailinglists']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['list']):
        $this->_foreach['mailinglists']['iteration']++;
?>
		<tr>
			<td><?php echo $this->_tpl_vars['list'][0]; ?>
</td>
			<td><?php echo $this->_tpl_vars['list'][1]; ?>
</td>
			<td>
				<input type="hidden" name="old[<?php echo $this->_tpl_vars['list'][0]; ?>
]" value="<?php if ($this->_tpl_vars['list'][2]): ?>1<?php else: ?>0<?php endif; ?>" />
				<input type="checkbox" name="new[<?php echo $this->_tpl_vars['list'][0]; ?>
]" value="1" <?php if ($this->_tpl_vars['list'][2]): ?>checked <?php endif; ?>/>
			</td>	
		<tr>
	<?php endforeach; endif; unset($_from); ?>
	</table>
	<input type="submit" name="submit" value="&Auml;nderungen speichern" />
</form>