<?php
// Archivo para el registro de usuarios

// Verificar si se recibieron datos por método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
<<<<<<< HEAD
    // Obtener los datos del formulario en formato JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que los campos no estén vacíos
    if (!empty($data['username']) && !empty($data['password'])) {
=======
    // Verificar si están definidos los datos del formulario
    if (isset($_POST['username']) && isset($_POST['password'])) {
>>>>>>> 0e51d300a0d04c673a45d68f40bcbfaad26f947c
        
        // Obtener los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];
        
<<<<<<< HEAD
        // Verificar si el usuario ya existe en la base de datos
        $query = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$data['username']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            // Si el usuario ya existe, devolver un mensaje de error
            $response = [
                "status" => "error",
                "message" => "El nombre de usuario ya existe."
            ];
        } else {
            // Si el usuario no existe, insertarlo en la base de datos
            $query = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$data['username'], password_hash($data['password'], PASSWORD_DEFAULT)]);
            
            // Confirmar el registro exitoso
            $response = [
                "status" => "success",
                "message" => "Registro exitoso."
=======
        // Validar que los campos no estén vacíos
        if (!empty($username) && !empty($password)) {
            
            // Conectar a la base de datos 
            require_once('db.php');
            
            // Verificar si el usuario ya existe en la base de datos
            $query = "SELECT * FROM usuarios WHERE username = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                // Si el usuario ya existe, devolver un mensaje de error
                $response = [
                    "status" => "error",
                    "message" => "El nombre de usuario ya existe."
                ];
            } else {
                // Si el usuario no existe, insertarlo en la base de datos
                $query = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
                
                // Confirmar el registro exitoso
                $response = [
                    "status" => "success",
                    "message" => "Registro exitoso."
                ];
            }
        } else {
            // Si algún campo está vacío, devolver un mensaje de error
            $response = [
                "status" => "error",
                "message" => "Por favor, completa todos los campos."
>>>>>>> 0e51d300a0d04c673a45d68f40bcbfaad26f947c
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
