

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda de Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* Estilos personalizados para la tarjeta de producto */
    .product-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease;
      margin-bottom: 15px; /* Espacio entre las tarjetas */
    }

    .product-card:hover {
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
      width: 100%;
      height: auto;
      border-bottom: 1px solid #ddd;
    }

    .product-card .card-body {
      padding: 15px;
    }

    .product-card .price {
      font-size: 14px;
      font-weight: bold;
      color: #007bff;
      margin-bottom: 0; /* Eliminar margen inferior */
    }
    
    .product-card .price span {
      font-size: 14px;
      font-weight: 200;
      color: #7f8082;
    }

    .product-card .description {
      font-size: 12px;
      font-family: Arial, Helvetica, sans-serif;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      color: #718096;
      text-overflow: ellipsis;
    }

    .product-card .btn-buy {
      width: 100%;
    }

    /* Estilos para el enlace */
    .product-link {
      color: inherit; /* Heredar el color del texto */
      text-decoration: none; /* Quitar la subrayado del enlace */
    }

    .product-link:hover {
      color: #0056b3; /* Cambiar el color del texto cuando se hace hover */
    }
    @media (max-width: 575px) {
      .product-card .description,
      .product-card .btn-buy {
        display: none; /* Ocultar descripción y botón de compra en pantallas pequeñas */
      }

      .row.no-gutters > [class*='col-'] {
        padding-right: 0;
        padding-left: 0;
      }
    }

    /* Estilo para los mapas */
    #map1, #map2 {
      width: 100%;
      height: 400px;
    }
  </style>
  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
</head>
<body>

  <nav class="nav">
    <a class="nav-link active" aria-current="page" href="#">
      <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo de la empresa" width="100">
    </a>
   
    <li class="nav-item">
      <a class="nav-link" href="{{ route('mision') }}">Misión&Visión </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('ubicaciones') }}">Ubicaciones</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa-brands fa-whatsapp fa-beat fa-2x" style="color: #00fa60;"></i></a>
    </li>
  </nav>

  <!-- Header -->
  <header class="bg-primary text-white text-center py-5">
    <div class="container">
      <h1 class="display-4">Nuestra dirección</h1>
      <p class="lead">Encuentra nuestras oficinas en las siguientes direcciones</p>
    </div>
  </header>


  <!-- Ubicaciones -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-6 mb-4">
        <section id="ubicaciones">
          <h2>Encuéntranos aquí Sucursal 1</h2>
          <!-- Contenedor del Mapa -->
          <div id="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3799.208053359271!2d-63.16211902482589!3d-17.781916483174157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTfCsDQ2JzU0LjkiUyA2M8KwMDknMzQuNCJX!5e0!3m2!1ses-419!2sbo!4v1716181747801!5m2!1ses-419!2sbo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
              
          </div>
      </section>
      </div>
      <div class="col-md-6 mb-4">
        <section id="ubicacionlp">
          <h2>Encuéntranos aquí en Sucursal 2</h2>
          <!-- Contenedor del Mapa -->
          <div id="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d3798.2713154600774!2d-63.2260225!3d-17.8259118!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTfCsDQ5JzMzLjMiUyA2M8KwMTMnMjQuNCJX!5e0!3m2!1ses-419!2sbo!4v1716181661837!5m2!1ses-419!2sbo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
      </section>
      
      </div>
    </div>
  </div>
  
<br>
<br>
  <!-- Footer -->
  @include('include/pie')

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>

  <!-- JavaScript para inicializar los mapas -->
  <script>

  </script>
</body>
</html>
