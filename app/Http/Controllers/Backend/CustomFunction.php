<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

class CustomFunction extends Controller {
    public static function ToastSettings() {
        $toast_setting = [
            "closeButton"       => true,
            "debug"             => false,
            "newestOnTop"       => false,
            "progressBar"       => true,
            "positionClass"     => "toast-top-right",
            "preventDuplicates" => false,
            "onclick"           => null,
            "showDuration"      => "300",
            "hideDuration"      => "1000",
            "timeOut"           => "5000",
            "extendedTimeOut"   => "1000",
            "showEasing"        => "swing",
            "hideEasing"        => "linear",
            "showMethod"        => "fadeIn",
            "hideMethod"        => "fadeOut",
        ];
        return $toast_setting;
    }


}