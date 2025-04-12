<?php

class Reserva {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }
    
    public function crearReserva($datosReserva) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO reservas (DNI_cliente, numero_mesa, fecha_hora_reserva, nombre_restaurante, estado_reserva, comentarios)
                VALUES (:dni_cliente, :numero_mesa, :fecha_hora_reserva, :nombre_restaurante, :estado_reserva, :comentarios)";
        
        // Ejecutar la consulta
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':dni_cliente', $datosReserva['dni_cliente']);
        $stmt->bindParam(':numero_mesa', $datosReserva['numero_mesa']);
        $stmt->bindParam(':fecha_hora_reserva', $datosReserva['fecha_hora_reserva']);
        $stmt->bindParam(':nombre_restaurante', $datosReserva['nombre_restaurante']);
        $stmt->bindParam(':estado_reserva', $datosReserva['estado_reserva']);
        $stmt->bindParam(':comentarios', $datosReserva['comentarios']);
        
        // Verificar si la inserción fue exitosa
        if ($stmt->execute()) {
            return true; // Reserva creada exitosamente
        } else {
            return false; // Error al crear la reserva
        }
    }
    public function verificarDisponibilidad($numero_mesa, $fecha_hora_reserva) {
        $sql = "SELECT COUNT(*) FROM reservas WHERE numero_mesa = :numero_mesa AND fecha_hora_reserva = :fecha_hora_reserva AND estado_reserva = 'confirmada'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':numero_mesa', $numero_mesa);
        $stmt->bindParam(':fecha_hora_reserva', $fecha_hora_reserva);
        $stmt->execute();
        return $stmt->fetchColumn() == 0; // Devuelve true si la mesa está disponible
    }

    public function cancelarReserva($id_reserva) {
        $sql = "UPDATE reservas SET estado_reserva = 'cancelada' WHERE id_reserva = :id_reserva";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_reserva', $id_reserva);
        return $stmt->execute(); // Devuelve true si la cancelación fue exitosa
    }

    public function obtenerReservasPorCliente($dni_cliente) {
        $sql = "SELECT * FROM reservas WHERE DNI_cliente = :dni_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':dni_cliente', $dni_cliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna un arreglo asociativo con las reservas
    }

    public function obtenerReservasPorRestaurante($nombre_restaurante, $fecha_reserva) {
        $sql = "SELECT * FROM reservas WHERE nombre_restaurante = :nombre_restaurante AND DATE(fecha_hora_reserva) = :fecha_reserva";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre_restaurante', $nombre_restaurante);
        $stmt->bindParam(':fecha_reserva', $fecha_reserva);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna las reservas como un arreglo asociativo
    }

    public function actualizarEstadoReserva($id_reserva, $nuevo_estado) {
        $sql = "UPDATE reservas SET estado_reserva = :nuevo_estado WHERE id_reserva = :id_reserva";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nuevo_estado', $nuevo_estado);
        $stmt->bindParam(':id_reserva', $id_reserva);
        return $stmt->execute(); // Devuelve true si la actualización fue exitosa
    }

    public function eliminarReserva($id_reserva) {
        $sql = "DELETE FROM reservas WHERE id_reserva = :id_reserva";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_reserva', $id_reserva);
        return $stmt->execute(); // Devuelve true si la eliminación fue exitosa
    }
    
    public function listarReservas() {
    $sql = "SELECT * FROM reservas";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
                
    
}    



?>