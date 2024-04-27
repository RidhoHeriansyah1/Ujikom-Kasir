<?php

use Carbon\Carbon;

function rupiah($amount) {
    return number_format($amount, 2, ',', '.');
}

function tanggal($tanggal){
    Carbon::setLocale('id');
    return Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y');
}