<?php
$ZHURNALPATH = ABSPATH . '/../zhurnal/';
require_once($ZHURNALPATH . 'zhurnal.inc.php');
$xmlpath = $ZHURNALPATH . 'zhurnaln.xml';
$xslpath = $ZHURNALPATH . 'zhurnalindex.xsl';

echo_xml_with_xsl($xmlpath, $xslpath);
?>