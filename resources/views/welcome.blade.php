<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Tienda</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    color: white;
    padding: 10px;
}

.right-icons {
    display: flex;
    align-items: center;
}

.search-panel {
    margin-left: 20px;
    margin-top: 20px;
}

.product-card {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.product-card img {
    max-width: 100%;
    height: auto;
}

.product-card h3 {
    margin-top: 0;
}

.product-card .product-price {
    font-weight: bold;
    margin-bottom: 10px;
}

.buy-button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.buy-button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <!-- Barra superior -->
    <div class="top-bar">
        <div class="logo">
            <!-- Logo de la empresa -->
            <img src="logo.png" alt="Logo de la empresa">
        </div>
        <div class="right-icons">
            <!-- Iconos de WhatsApp u otros -->
            <img src="whatsapp.png" alt="WhatsApp">
            <!-- Botón de login/logout -->
            <button>Iniciar Sesión</button>
        </div>
    </div>
    
    <!-- Contenido principal -->
    <div class="main-content">
        <!-- Panel de búsqueda -->
        <div class="search-panel">
            <input type="text" id="search-input" placeholder="Buscar...">
            <select id="category-select">
                <option value="">Todas las categorías</option>
                <!-- Opciones de categorías generadas dinámicamente -->
            </select>
        </div>

        <!-- Lista de productos en tarjetas -->
        <div class="product-list">
            <!-- Tarjeta de ejemplo -->
            <div class="product-card">
                <img src="product-image.jpg" alt="Producto 1">
                <h3>Nombre del Producto</h3>
                <p>Descripción del producto</p>
                <div class="product-price">$XX.XX</div>
                <button class="buy-button">Comprar</button>
            </div>
            <!-- Otras tarjetas de productos se generarán dinámicamente -->
        </div>
    </div>

    <!-- Script JavaScript (jQuery) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>



{{-- 2<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <!-- Agrega enlaces a tus hojas de estilo y scripts aquí -->
</head>
<body>
    <!-- Barra superior -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px;">
        <div>
            <img src="ruta_al_logo_empresa.png" alt="Logo de la empresa" style="height: 50px;">
        </div>
        <div>
            <!-- Iconos de WhatsApp u otros métodos de contacto -->
            <img src="icono_whatsapp.png" alt="WhatsApp">
        </div>
    </div>

    <!-- Contenedor principal -->
    <div style="display: flex;">
        <!-- Panel izquierdo con cuadro de búsqueda y filtro -->
        <div style="flex: 0 0 20%; padding: 20px;">
            <input type="text" id="search" placeholder="Buscar...">
            <select id="category">
                <option value="">Todas las categorías</option>
                <!-- Aquí puedes cargar las opciones de categorías desde tu base de datos -->
            </select>
        </div>

        <!-- Contenido principal -->
        <div style="flex: 1; padding: 20px;">
            <!-- Aquí puedes mostrar parte del nombre del producto -->
            <h1>Bienvenido</h1>
            <!-- Agrega tus productos aquí -->
        </div>
    </div>

    <!-- Botón de compra -->
    <div style="text-align: center; margin-bottom: 20px;">
        <button style="padding: 10px 20px; font-size: 18px;">Comprar</button>
    </div>

    <!-- Script para la funcionalidad de búsqueda y filtrado -->
    <script>
        // Aquí puedes agregar tu código JavaScript para implementar AJAX y filtrar los productos
    </script>
</body>
</html>

 --}}





{{-- 1 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jhimbo</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo-min.png') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <!-- Styles -->
    <style>
        body {
            font-family: 'figtree', sans-serif;
            margin: 0;
            padding: 0;
            line-height: inherit;
            background-image: url({{ asset('assets/images/main/ventas.jpg') }});
            background-size: cover;
       
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .main-container {
            background-color: #ffffff;
            /* Color de fondo del contenedor principal */
            border: 1px solid #17AEDF;
            /* Borde global al contenedor principal */
            border-radius: 0.375rem;
            /* Borde redondeado */
            overflow: hidden;
            /* Ajustar el borde al contenido */
            padding: 1rem;
            /* Espaciado interno */
            margin-bottom: 1rem;
            /* Margen inferior */
            box-shadow: 0 0 0 15px rgba(0, 0, 0, 0.2);
            /* Sombra */
        }

        .title {
            font-size: 2rem;
            font-weight: 600;
            color: #676E8A;
            /* Color del texto */
            text-align: center;
            margin-bottom: 1rem;
        }

        .links-container {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            border-top: 2px solid #e2e8f0;
            /* Borde superior para separar del título */
            padding-top: 1rem;
            /* Espaciado interno en la parte superior */
        }

        .link-wrapper {
            margin: 0 1rem;
            overflow: hidden;
            /* Ajustar el borde al contenido */
        }

        .links {
            text-decoration: none;
            background: #17AEDF;
            color: #ffffff;
            /* Color de los enlaces */
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            display: block;
            border-radius: 10px;
            transition: color 0.4s ease-in-out; 
        }

        .links:hover {
            color: #718096;
            /* Cambia el color al pasar el ratón */
        }

        /* Efecto de hover para los botones */
        .links:hover {
            background-color: #e2e8f0;
            /* Cambia el color de fondo al pasar el ratón */
            color: #2d3748;
            /* Cambia el color del texto al pasar el ratón */
        }
    </style>


</head>

<body>
    <div class="container">
        <div class="main-container">
            <div class="title">
                @auth
                Bienvenido al Sistema de Ventas
                @else
                Inicia sesión o Regístrate
                @endauth
            </div>

            @if (Route::has('login'))
            <div class="links-container">
                <div class="link-wrapper">
                    <a href="{{ route('login') }}" class="links">Iniciar sesión</a>
                </div>

                @if (Route::has('register'))
                <div class="link-wrapper">
                    <a href="{{ route('register') }}" class="links">Registrarse</a>
                </div>
                @endif
            </div>
            @endif
        </div>

    </div>
</body>

</html> --}}