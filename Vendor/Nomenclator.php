<?php

namespace JoomlaDev\Vendor;

class Nomenclator {

   protected static $_comprefix = "com";
   protected static $_modprefix = "mod";
   protected static $_plgprefix = "plg";
   protected static $_separator = "_";

   public static function componentize($name) {
      return  strtolower(static::$_comprefix . static::$_separator . Inflector::pluralize($name));
   }

   public static function modularize($name) {
         return  strtolower(static::$_modprefix . static::$_separator . Inflector::pluralize($name));
   }

   public static function pluginize($name) {
         return  strtolower(static::$_plgprefix . static::$_separator . Inflector::pluralize($name));
   }

}

?>
