<?php

use JetBrains\PhpStorm\Pure;

function btnAction($action = '', $attrBtn = '', $labelBtn = '', $classBtn = '', $typeBtn = '', $icon = ''): string
{
    switch ($action) {
        case 'back':
            $type = 'danger-gradien';
            $iconBtn = 'backward';
            break;
        case 'update':
            $type = 'warning-gradien';
            $iconBtn = 'pencil';
            break;
        case 'delete':
            $type = 'danger-gradien';
            $iconBtn = 'trash';
            break;
        case 'save':
            $type = 'primary-gradien';
            $iconBtn = 'save';
            break;
        case 'search':
            $type = 'primary-gradien';
            $iconBtn = 'search';
            break;
        case 'posting':
            $type = 'danger-gradien';
            $iconBtn = 'send';
            break;
        case 'print':
            $type = 'warning-gradien';
            $iconBtn = 'print';
            break;
        case 'add' || 'plus':
            $type = 'primary-gradien';
            $iconBtn = 'plus-circle';
            break;
        default:
            $type = 'dark-gradien';
            $iconBtn = '';
            break;
    }
    $icon = $icon ?: $iconBtn;
    $typeBtn = $typeBtn ?: $type;
    return "<button $attrBtn class='btn btn-$typeBtn btn-sm $classBtn'><i class='bi bi-$icon me-0'></i> $labelBtn</button>";
}


function numberFormat(int $number, $decimals = 0): string
{
    return number_format($number, $decimals, ',', '.');
}

function formatDateIndo(string $date): string
{
    return \Carbon\Carbon::parse($date)->format('d-m-Y');
}

function formatDateMonthIndo($date): string
{
    if (!$date) return 'NULL';
    $day = day($date);
    $month = monthIndo(month($date));
    $year = year($date);
    return $day . ' ' . $month . ' ' . $year;
}

function day($date): string
{
    return date("d", strtotime($date));
}

function month($date): string
{
    return date("m", strtotime($date));
}

function year($date): string
{
    return date("Y", strtotime($date));
}

function monthIndo(int $month): string
{
    return match ($month) {
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember",
        default => 'NULL'
    };
}

function sprintfNumber(int $number, int $length = 3): string
{
    return sprintf("%'.0" . $length . "s", $number);
}

function sptNumber(int $number): string
{
    $number = sprintfNumber($number);
    return "090/{$number}/Disnakertrans/LK3";
}
