<?php

namespace App\Libraries;

use TCPDF;

class MY_TCPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = ROOTPATH.'public/gambar/polban.png';
        /**
         * width : 50
         */
        $this->Image($image_file, '', '', 20);

    }
}