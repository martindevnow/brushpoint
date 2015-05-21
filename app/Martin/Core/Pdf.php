<?php


namespace Martin\Core;


class Pdf extends \mikehaertl\wkhtmlto\Pdf {

    public function __construct($options=null)
    {
        parent::__construct($options);
        $this->tmpDir = public_path()."/tmp";
        $this->_command = "/usr/local/bin/wkhtmltopdf ";
    }
} 