<?php

namespace Lib;

class Aries_Exception extends \Exception {

    /**
     * Generate new exception.
     *
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString() {
        return __CLASS__.": [{$this->code}]: {$this->message}\n";
    }

}
