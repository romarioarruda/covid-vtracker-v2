<?php

class AppException extends Exception {

    public function __construct($message, $code = 0, $previous = null) {
        exit($message);
        parent::__construct($message, $code, $previous);
    }
}