<?php

use Carbon\Carbon;

/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('whatsappNumber')) {
    function whatsappNumber($number)
    {
        // Hilangkan spasi atau karakter selain angka dan tanda "+" (jika ada)
        $number = preg_replace('/\s+/', '', $number);

        // Jika nomor diawali dengan "0", ubah menjadi "62"
        if (substr($number, 0, 1) === '0') {
            return '62' . substr($number, 1);
        }

        // Jika nomor diawali dengan "+", hapus tanda "+"
        if (substr($number, 0, 1) === '+') {
            return substr($number, 1);
        }

        // Jika nomor diawali dengan "62", biarkan
        if (substr($number, 0, 2) === '62') {
            return $number;
        }

        // Jika format tidak sesuai,
    }
}
