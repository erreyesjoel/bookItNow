<?php
class User {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function findOrCreateGoogleUser($googleId, $name, $email) {
        // Verificar si el usuario ya existe por su Google ID o correo
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
        $query = "INSERT INTO usuarios (nombre, correo, google_id, tipo_registro, estado, email_verificado) 
                  VALUES (:name, :email, :google_id, 'google', 'activo', true)";
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
            'tipo_registro' => 'google',
            'estado' => 'activo',
            'email_verificado' => true
        ];
    }
    public function createTraditionalUser($name, $email, $password) {
        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        // Crear el usuario
        $query = "INSERT INTO usuarios (nombre, correo, password, tipo_registro, estado, email_verificado) 
                  VALUES (:name, :email, :password, 'tradicional', 'activo', false)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    
        // Devolver el nuevo usuario
        return [
            'id' => $this->db->lastInsertId(),
            'nombre' => $name,
            'correo' => $email,
            'tipo_registro' => 'tradicional',
            'estado' => 'activo',
            'email_verificado' => false
        ];
    }
    public function getUserById($userId) {
        $query = "SELECT nombre FROM usuarios WHERE id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un array asociativo con los datos del usuario
    }    
}
?>
