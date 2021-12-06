<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('getBulan')) {
    function getBulan($bln)
    {
        $namaBulan = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];
        return $namaBulan[$bln - 1];
    }
}
