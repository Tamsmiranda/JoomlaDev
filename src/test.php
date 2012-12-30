<?php

namespace JoomlaDev\src;

use JoomlaDev\Vendor;

require "../Vendor/Inflector.php";

echo "asdasd\n";
$asd = new Vendor\Inflector();
echo $asd->pluralize("name") . "\n";
echo Vendor\Inflector::pluralize('iogurt') . "\n";

?>
