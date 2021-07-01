<?php

$smarty = new Smarty();

$smarty->setTemplateDir($conf['site_path'] . 'templates');
$smarty->setCompileDir($conf['site_path'] . 'cache/templates_c');
$smarty->setCacheDir($conf['site_path'] . 'cache');
$smarty->setConfigDir($conf['site_path'] . 'config/sm_config');