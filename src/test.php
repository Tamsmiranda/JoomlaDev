<?php

namespace JoomlaDev\src;

use JoomlaDev\Vendor;

require "../Vendor/Inflector.php";
require "../Vendor/Nomenclator.php";

echo "asdasd\n";
$asd = new Vendor\Inflector();
echo $asd->pluralize("name") . "\n";
echo Vendor\Inflector::pluralize('iogurt') . "\n";
echo Vendor\Nomenclator::componentize('forSale') . "\n";
echo Vendor\Nomenclator::modularize('forSale') . "\n";
echo Vendor\Nomenclator::pluginize('forSale') . "\n";

?>
