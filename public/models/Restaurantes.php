<?php

class Restaurantes {
    private $db;

    // constructor

    public function __construct($db) {
        $this->db = $db;
    }
    
    // metodo obtenerRestaurantes
    /* la variable stmt, indica como que la consulta sql ya esta preparada o la preparamos, entonces, la ejecutamos */
    public function obtenerRestaurantes() {
        $consultaSql = "SELECT nombre_restaurante, direccion, telefono, foto FROM restaurantes"; 
        $stmt = $this->db->prepare($consultaSql);
        $stmt->execute(); // dado que la consulta esta preparada, la ejecutamos
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // recuperamos los registros de la consulta, en forma de array asociativo
    }
    }

?>
