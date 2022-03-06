<?php

class conexion{
    //DB local
    const user='root';
    const pass='';
    const db='proyecto_final_iot';
    const servidor='localhost';


    public function conectardb(){
        $conectar = new mysqli(self::servidor, self::user, self::pass, self::db);
        if($conectar->connect_error){
            die("Error en la conexion".$conectar->connect_error);
        }
        return $conectar;
    }
}

?>