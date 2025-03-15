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
        $consultaSql = "SELECT nombre_restaurante, direccion, telefono, foto 
                        FROM restaurantes 
                        ORDER BY nombre_restaurante DESC 
                        LIMIT 4"; /* coger solo 4, creo que asi quedaria mas chulo por ahora, era facil, modificar la consulta y ya, no tiene mucho misterio :) */
        $stmt = $this->db->prepare($consultaSql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    }

?>
