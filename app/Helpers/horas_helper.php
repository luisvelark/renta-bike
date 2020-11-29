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
function restarMinutos($horaInicio, $cantidadMinutos)
{
    $hora = strtotime($horaInicio);
    $miHora = date('H:i:s', $hora);

    $newHora = strtotime('+0 hour', strtotime($miHora));
    $newHora = strtotime('-'.$cantidadMinutos.' minute', $newHora);
    $newHora = strtotime('-0 second', $newHora);
    $newHora = date('H:i:s', $newHora);
    return $newHora;

}
function sumarMinutos($horaInicio, $cantidadMinutos)
{
    $hora = strtotime($horaInicio);
    $miHora = date('H:i:s', $hora);

    $newHora = strtotime('+0 hour', strtotime($miHora));
    $newHora = strtotime('+'.$cantidadMinutos.' minute', $newHora);
    $newHora = strtotime('-0 second', $newHora);
    $newHora = date('H:i:s', $newHora);
    return $newHora;

}

?>