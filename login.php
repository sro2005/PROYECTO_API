<?php
// Archivo para el inicio de sesión de usuarios

// Verificar si se recibieron datos por método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener los datos del formulario en formato JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que los campos no estén vacíos
    if (!empty($data['username']) && !empty($data['password'])) {
        
        // Conectar a la base de datos 
        require_once('db.php');
        
        // Verificar las credenciales del usuario
        $query = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$data['username']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            // Si el usuario existe, verificar la contraseña
            if (password_verify($data['password'], $row['password'])) {
                // Contraseña correcta, autenticación exitosa
                $response = [
                    "status" => "success",
                    "message" => "Autenticación satisfactoria."
                ];
            } else {
                // Contraseña incorrecta, devolver un mensaje de error
                $response = [
                    "status" => "error",
                    "message" => "Contraseña incorrecta."
                ];
            }
        } else {
            // Si el usuario no existe, devolver un mensaje de error
            $response = [
                "status" => "error",
                "message" => "Usuario no encontrado."
            ];
        }
    } else {
        // Si algún campo está vacío, devolver un mensaje de error
        $response = [
            "status" => "error",
            "message" => "Por favor, completa todos los campos."
        ];
    }
} else {
    // Si no es una solicitud POST, devolver un mensaje de error
    $response = [
        "status" => "error",
        "message" => "Método no permitido."
    ];
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
