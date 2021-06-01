<?php
    namespace Cgat\Core;

    /*
    * Source: "Learning PHP 7 by Antonio Lopez"
    * Filters data send by User via Get and Post method and Cookies.
    * It is used:
    * - to protect against malicious code send bu User
    * - to validate format of data send by User
    * - to check if data contain required key
    */
    class FilteredMap {
        private $data;

        // $data: data sedn by User to be filtered
        public function __construct($data) {
            $this->data = $data;
        }

        public function hasKey($key) {
            return isset($this->data[$key]);
        }

        public function getValue($key) {
            // return $this->data[$key] ?? "null"; // The null coalesce operator (??) has been added as syntactic sugar for the common case of needing to use a ternary in conjunction with isset(). It returns its first operand if it exists and is not NULL; otherwise it returns its second operand.
            return isset($this->data[$key]) ? $this->data[$key] : null;
        }

        /*
        * Set of filters
        */

        public function getInt($key) {
            return (int) $this->getValue($key);
        }

        public function getNumber($key) {
            return (float) $this->getValue($key);
        }

        public function getString($key, $filter = true) {
            $value = (string) $this->getValue($key);
            return $filter ? addslashes($value) : $value;
        }

    }

?>