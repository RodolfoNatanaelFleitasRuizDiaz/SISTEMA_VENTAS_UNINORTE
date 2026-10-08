<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        body {
            transition: background-color 0.4s ease; /* Transición suave */
            text-align: center;
            font-family: Arial, sans-serif;
            padding-top: 50px;
        }
        button {
            padding: 12px 24px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            background-color: #4CAF50;
            color: white;
            margin-top: 20px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    
    <button onclick="cambiarColor()">Cambiar color</button>

    <script>
        // Lista de colores
        const colores = ["#f0f0f0", "#ffcccc", "#ccffcc", "#ccccff", "#ffffcc", "#ffccff", "#e0f7fa"];
        let indice = 0;

        function cambiarColor() {
            indice = (indice + 1) % colores.length; // Cicla entre los colores
            document.body.style.backgroundColor = colores[indice];
        }
    </script>
</body>
</html>