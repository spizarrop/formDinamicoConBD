<?php

function checkboxAcciones()
{
    $acciones = [
        "reciclaje" => "Reciclo mis residuos",
        "transporte" => "Uso transporte público o bicicleta",
        "co2" => "Ayudo a disminuir el uso de CO2"
    ];
    return $acciones;
}

function selectRegiones()
{
    $region = [
        "europa" => "Europa",
        "america" => "América",
        "asia" => "Asia",
        "africa" => "África",
        "oceania" => "Oceanía",
    ];
    return $region;
}

?>