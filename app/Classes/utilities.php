<?php 

namespace App\Classes;

class Utilities
{
    public static function errorMessage($e)
    {
        if (!empty($e->errorInfo[1])) {
            switch ($e->errorInfo[1]) {
                case 1062:
                    $mensaje = 'Registre duplicat';
                    break;
                case 1451:
                    $mensaje = 'Registre amb dades relacionades';
                    break;
                default:
                    $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
                    break;
            }
        } else {
            switch ($e->getCode()) {
                case 1044:
                    $mensaje = 'Usuari o contrasenya incorrecte';
                    break;
                case 1049:
                    $mensaje = 'Base de dades desconeguda';
                    break;
                case 2002:
                    $mensaje = 'No es pot connectar al servidor de base de dades';
                    break;
                default:
                    $mensaje = $e->getCode() . ' - ' . $e->getMessaGE();
                    break;
            }
        }

        return $mensaje;
    }
}