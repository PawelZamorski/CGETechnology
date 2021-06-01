<?php
    namespace Cgat\Core;

    use Cgat\Utils\NotFoundException;

    /*
    * Source: "Learning PHP 7 by Antonio Lopez"
    * Use Singleton pattern
    * 
    * This class reads the config file and converts it to the array during instantiation.
    * It is very expensive operation (reading file, conversion). Data from config file may be needed in different parts of programm.
    * It is good to instantiate this class only once.
    * Using static doesn't ensure, that the class will not be instantiated again.
    * The best soultion is to use Singleton Pattern.

    * Implementing a singleton implies the following points:
    * 1. Make the constructor of the class private, so absolutely no one from outside
    * the class can ever instantiate that class.
    * 2. Create a static property named $instance, which will contain an instance of
    * itself—that is, in our Config class, the $instance property will contain an
    * instance of the class Config.
    * 3. Create a static method, getInstance, which will check if $instance is null,
    * and if it is, it will create a new instance using the private constructor. Either
    * way, it will return the $instance property.
    */

    class Config {
        private static $instance;
        private $data;

        private function __construct() {
            $json = file_get_contents(__DIR__ . '/../../config/config.json');
            $this->data = json_decode($json, true);
        }

        public static function getConfig() {
            if(self::$instance == null) {
                self::$instance = new Config();
            }
            return self::$instance;
        }

        public function get($key) {
            if (!isset($this->data[$key])) {
                throw new NotFoundException("Key $key not in config.");
            }
            return $this->data[$key];
        }
    }
?>

