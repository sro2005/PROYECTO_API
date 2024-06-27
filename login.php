<?php
// Archivo para el inicio de sesión de usuarios

// Verificar si se recibieron datos por método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verificar si están definidos los datos del formulario
    if (isset($_POST['new_user']) && isset($_POST['new_password'])) {
        
        // Obtener los datos del formulario
        $username = $_POST['new_user'];
        $password = $_POST['new_password'];
        
        // Validar que los campos no estén vacíos
        if (!empty($username) && !empty($password)) {
            
            // Conectar a la base de datos (reemplaza con tus credenciales)
            require_once('db.php');
            
            // Verificar las credenciales del usuario
            $query = "SELECT * FROM usuarios WHERE username = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                // Si el usuario existe, verificar la contraseña
                if (password_verify($password, $row['password'])) {
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
        // Si no están definidos todos los campos necesarios, devolver un mensaje de error
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
