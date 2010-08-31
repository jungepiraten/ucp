<?php /* Smarty version 2.6.20, created on 2010-08-31 15:44:55
         compiled from delete_mail.tpl */ ?>
<p>Mailadresse <strong><?php echo $this->_tpl_vars['mail']; ?>
</strong> von ihrem Konto l&ouml;schen?</p>
<form action="?do=delete_mail" class="delete_mail" method="post">
	<input type="hidden" name="mail" value="<?php echo $this->_tpl_vars['mail']; ?>
" />
	<table>
	<tr>
		<th>Mailinglisten ...</th>
		<td>
		 <?php echo '<select name="listsoption" onchange="if (this.value==\'move\') {document.getElementsByName(\'movemail\')[0].style.display=\'inline\';} else {document.getElementsByName(\'movemail\')[0].style.display=\'none\';}">'; ?>

		  <option value="delete">L&ouml;schen</option>
		  <option value="ignore">Beibehalten</option>
		  <option value="move" selected="selected">Verschieben:</option>
		 </select>
		 <select name="movemail">
		  <?php $_from = $this->_tpl_vars['mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['movemail']):
?>
		   <?php if ($this->_tpl_vars['movemail'] != $this->_tpl_vars['mail']): ?>
		    <option><?php echo $this->_tpl_vars['movemail']; ?>
</option>
		   <?php endif; ?>
		  <?php endforeach; endif; unset($_from); ?>
		 </select>
		 <?php echo '<script type="text/javascript">document.getElementsByName(\'listsoption\')[0].onchange();</script>'; ?>

		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="act" value="l&ouml;schen" /></td>
	</tr>
	</table>
</form>