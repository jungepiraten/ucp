<?php /* Smarty version 2.6.20, created on 2010-08-18 04:18:27
         compiled from delete_mail.tpl */ ?>
<p>Mailadresse <?php echo $this->_tpl_vars['mail']; ?>
 von ihrem Konto l&ouml;schen?</p>
<form action="?do=delete_mail" method="post">
	<input type="hidden" name="mail" value="<?php echo $this->_tpl_vars['mail']; ?>
" />
	<b>Mailinglisten ...</b>
	<input type="radio" name="listsoption" value="delete" /> L&ouml;schen
	<input type="radio" name="listsoption" value="ignore" /> Beibehalten<br />
	<input type="submit" name="act" value="l&ouml;schen" />
</form>