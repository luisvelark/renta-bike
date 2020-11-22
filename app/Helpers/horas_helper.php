<?php

function calcularSumaHoras($horaInicio, $cantHora)
{
    $hora = strtotime($horaInicio);
    $miHora = date('H:i:s', $hora);

    $newHora = strtotime('+' . $cantHora . ' hour', strtotime($miHora));
    $newHora = strtotime('+0 minute', $newHora);
    $newHora = strtotime('-0 second', $newHora);
    $newHora = date('H:i:s', $newHora);

    return $newHora;

}