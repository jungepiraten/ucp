<?php

function ldap_escape($str, $for_dn = false)
{
	if  ($for_dn)
		$metaChars = array(',','=', '+', '<','>',';', '\\', '"', '#');
	else
		$metaChars = array('*', '(', ')', '\\', chr(0));

	$quotedMetaChars = array();
	foreach ($metaChars as $key => $value) $quotedMetaChars[$key] = '\\'.str_pad(dechex(ord($value)), 2, '0');
	$str=str_replace($metaChars,$quotedMetaChars,$str);
	return ($str);
}

?>
