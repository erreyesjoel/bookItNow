<?php
class User {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function findOrCreateGoogleUser($googleId, $name, $email) {
        // Verificar si el usuario ya existe por su Google ID
        $query = "SELECT * FROM usuarios WHERE google_id = :google_id OR correo = :email";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':google_id' => $googleId,
            ':email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user; // Si el usuario ya existe, devolverlo
        }

        // Si no existe, lo creamos
        $query = "INSERT INTO usuarios (nombre, correo, google_id, estado) VALUES (:name, :email, :google_id, 'activo')";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':google_id' => $googleId
        ]);

        // Devolver el nuevo usuario
        return [
            'id' => $this->db->lastInsertId(),
            'nombre' => $name,
            'correo' => $email,
            'google_id' => $googleId,
            'estado' => 'activo'
        ];
    }
}
?>
