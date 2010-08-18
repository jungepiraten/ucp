<?php /* Smarty version 2.6.20, created on 2010-08-18 05:10:53
         compiled from lists.tpl */ ?>
<?php echo '
<script type="text/javascript">
<!--

function unfold(id) {
	document.getElementById(\'ml\' + id + \'-fold\').style.display = \'none\';
	document.getElementById(\'ml\' + id + \'-unfold\').style.display = \'block\';
}

function fold(id) {
	document.getElementById(\'ml\' + id + \'-fold\').style.display = \'block\';
	document.getElementById(\'ml\' + id + \'-unfold\').style.display = \'none\';
}

//-->
</script>
'; ?>

<form action="<?php echo $this->_tpl_vars['PHP_SELF']; ?>
" method="post">
<!--
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
-->
	<?php $_from = $this->_tpl_vars['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mailinglists'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mailinglists']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['list']):
        $this->_foreach['mailinglists']['iteration']++;
?>
		<div id="ml<?php echo $this->_tpl_vars['id']; ?>
-fold">
			<a href="javascript:void" onClick="unfold('<?php echo $this->_tpl_vars['id']; ?>
');" class="listname">
				<img src="data/images/unfold.png" class="fold" />
				<?php echo $this->_tpl_vars['list'][0]; ?>

				<?php if ($this->_tpl_vars['list'][2]): ?><img src="data/images/active.png" alt="[x]" class="active" /><?php endif; ?>
			</a>
			<span class="listdesc"><?php echo $this->_tpl_vars['list'][1]; ?>
</span>
		</div>
		<div id="ml<?php echo $this->_tpl_vars['id']; ?>
-unfold" style="display:none;">
			<a href="javascript:void" onClick="fold('<?php echo $this->_tpl_vars['id']; ?>
');" class="listname">
				<img src="data/images/fold.png" class="fold" />
				<?php echo $this->_tpl_vars['list'][0]; ?>

				<?php if ($this->_tpl_vars['list'][2]): ?><img src="data/images/active.png" alt="[x]" class="active" /><?php endif; ?>
			</a>
			<span class="listdesc"><?php echo $this->_tpl_vars['list'][1]; ?>
</span>
			<div class="mails">
				<?php $_from = $this->_tpl_vars['mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mail']):
?>
					<input type="hidden" name="old[<?php echo $this->_tpl_vars['mail']; ?>
][<?php echo $this->_tpl_vars['list'][0]; ?>
]" value="<?php if (in_array ( $this->_tpl_vars['mail'] , $this->_tpl_vars['list'][3] )): ?>1<?php else: ?>0<?php endif; ?>" />
					<input type="checkbox" name="new[<?php echo $this->_tpl_vars['mail']; ?>
][<?php echo $this->_tpl_vars['list'][0]; ?>
]" value="1" <?php if (in_array ( $this->_tpl_vars['mail'] , $this->_tpl_vars['list'][3] )): ?>checked="checked" <?php endif; ?>/>
					<?php echo $this->_tpl_vars['mail']; ?>
<br />
				<?php endforeach; endif; unset($_from); ?>
			</div>
		</div>
	<?php endforeach; endif; unset($_from); ?>
	<input type="submit" name="submit" value="&Auml;nderungen speichern" />
</form>