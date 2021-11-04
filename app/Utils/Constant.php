<?php 
namespace App\Utils;

class Constant {
    const COMMON_MODE_EDIT     = 'edit';
    const COMMON_MODE_DETAIL   = 'detail';
    const COMMON_MODE_LIST     = [
        self::COMMON_MODE_EDIT     => 'Edit',
        self::COMMON_MODE_DETAIL   => 'Detail',
    ];
}

?>