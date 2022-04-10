<?php

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
            $iconBtn = 'power-off';
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
