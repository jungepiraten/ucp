<?php /* Smarty version 2.6.20, created on 2010-08-18 18:02:34
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
				<!-- <input type="checkbox" name="new[<?php echo $this->_tpl_vars['list'][0]; ?>
]" value="1" <?php if ($this->_tpl_vars['list'][2]): ?>checked <?php endif; ?>/> -->
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
	</table>

<!--
	<?php $_from = $this->_tpl_vars['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mailinglists'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mailinglists']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['list']):
        $this->_foreach['mailinglists']['iteration']++;
?>
		<div id="ml<?php echo $this->_tpl_vars['id']; ?>
-fold" style="display:none;">
			<a href="javascript:" onClick="unfold('<?php echo $this->_tpl_vars['id']; ?>
');" class="listname">
				<img src="data/images/unfold.png" class="fold" />
				<?php echo $this->_tpl_vars['list'][0]; ?>

				<?php if ($this->_tpl_vars['list'][2]): ?><img src="data/images/active.png" alt="[x]" class="active" /><?php endif; ?>
			</a>
			<span class="listdesc"><?php echo $this->_tpl_vars['list'][1]; ?>
</span>
		</div>
		<div id="ml<?php echo $this->_tpl_vars['id']; ?>
-unfold">
			<a href="javascript:" onClick="fold('<?php echo $this->_tpl_vars['id']; ?>
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
<?php $_from = $this->_tpl_vars['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mailinglists'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mailinglists']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['list']):
        $this->_foreach['mailinglists']['iteration']++;
?>
<script type="text/javascript">
<?php if ($this->_tpl_vars['list'][2]): ?>
unfold('<?php echo $this->_tpl_vars['id']; ?>
');
<?php else: ?>
fold('<?php echo $this->_tpl_vars['id']; ?>
');
<?php endif; ?>
</script>
<?php endforeach; endif; unset($_from); ?>
-->
	<input type="submit" name="save" value="&Auml;nderungen speichern" />
</form>