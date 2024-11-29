<?php
header('Content-Type: application/json'); // Especifica que la respuesta será JSON

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'papeleria_db'); // Cambia 'nombre_base_datos' por el nombre real de tu base de datos

if ($conexion->connect_error) {
    die(json_encode(['success' => false, 'error' => $conexion->connect_error]));
}

// Procesar solo solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leer los datos enviados desde el cliente
    $data = json_decode(file_get_contents('php://input'), true);

    // Validar y sanitizar los datos
    $name = $conexion->real_escape_string($data['name']);
    $description = $conexion->real_escape_string($data['description']);
    $price = $conexion->real_escape_string($data['price']);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO carrito (nombre, descripcion, precio) VALUES ('$name', '$description', '$price')";
    if ($conexion->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conexion->error]);
    }

    // Cerrar conexión
    $conexion->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}


// Función para agregar un producto al carrito
function agregarAlCarrito(nombre, descripcion, precio) {
    // Datos que se enviarán al servidor
    const data = {
        name: nombre,
        description: descripcion,
        price: precio
    };

    // Enviar la solicitud POST a PHP
    fetch('php/crud_add.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)  // Convertir los datos a JSON
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Producto agregado al carrito con éxito');
        } else {
            alert('Error al agregar producto: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al agregar el producto');
    });
}

// Llamar a la función cuando se presione el botón de agregar al carrito
document.getElementById('botonCarrito').addEventListener('click', function() {
    agregarAlCarrito('Carpeta de Cuero', 'Carpeta tamaño A6, ideal para organizadores', 50.70);
});


// Corregir el error de carrito xd 
?>


