<?php

if (!defined('ALLOW_PAGSEGURO_CONFIG')) { die('NOT ALLOWED'); }

$PagSeguroConfig = array();

$PagSeguroConfig['enviroment'] = array();
$PagSeguroConfig['enviroment']['enviroment'] = "production";

$PagSeguroConfig['credentials'] = array();
$PagSeguroConfig['credentials']['email'] = "your@email.com";
$PagSeguroConfig['credentials']['token'] = "your_token_here";

$PagSeguroConfig['application'] = array();
$PagSeguroConfig['application']['charset'] = "ISO-8859-1"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = array();
$PagSeguroConfig['log']['active'] = FALSE;
$PagSeguroConfig['log']['fileLocation'] = "";

?>