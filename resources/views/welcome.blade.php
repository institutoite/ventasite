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
  </style>
</head>
<body>
  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo de la empresa" width="50"></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-brands fa-whatsapp fa-beat fa-2x" style="color: #00fa60;"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="mt-4">
        <div class="row">
            <div class="col-md-2">
                <input type="text" id="busqueda" class="form-control mb-3" placeholder="Buscar...">
                <select id="categorias" class="form-select mb-3">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $categoria)
                      <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                    @endforeach
                </select>
                <select id="marcas" class="form-select mb-3">
                    <option value="">Todas las marcas</option>
                    @foreach ($marcas as $marca)
                      <option value="{{ $marca->id }}">{{ $marca->marca }}</option>
                    @endforeach
                </select>
            </div>
      <div class="col-md-10">
            <div class="row no-gutters">
                @foreach ($products as $product)
                <div class="col-6 col-xs-6 col-sm-6 col-md-4 col-lg-3 mb-0"> 
                  <a href="{{ route("show.product.public",$product->id) }}" class="product-link"> <!-- Enlace para toda la tarjeta -->
                    <div class="product-card">
                      <img src="{{ asset('storage/products/'.$product->product_image) }}" alt="Producto 1">
                      <div class="card-body">
                        <p class="price mb-0">Bs. {{ $product->precio1 }} <span>{{ $product->product_name }}</span></p> 
                        <h5 class="description">{{ $product->descripcion }}</h5>
                        <button class="btn btn-buy" onclick="event.stopPropagation();"><i class="fa-solid fa-share-nodes fa-bounce fa-2x"></i></button> <!-- Detener la propagación del evento de clic para que no afecte al enlace -->
                      </div>
                    </div>
                  </a>
                </div>
                @endforeach
            </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
        // Función para cargar productos según la categoría seleccionada
        function cargarProductos(categoria) {
          $.ajax({
            url: "{{ route('productos.de.una.categoria') }}", // Reemplaza 'ruta_del_servidor_para_obtener_productos' por la ruta correcta en tu servidor
            method: 'get', // Método HTTP utilizado para la solicitud
            data: { categoria: categoria }, // Datos enviados al servidor (en este caso, la categoría seleccionada)
            success: function(response) {
              // Manejar la respuesta del servidor y actualizar la lista de productos
              $('#lista-productos').html(response);
              console.log(response);
            },
            error: function(xhr, status, error) {
              // Manejar errores de la solicitud AJAX
              console.error('Error al cargar productos:', error);
            }
          });
        }

        // Escuchar cambios en el select de categorías
        $('#categorias').change(function() {
          var categoriaSeleccionada = $(this).val();
    
          cargarProductos(categoriaSeleccionada);
        });

        // Cargar todos los productos al cargar la página (sin filtro de categoría)
        cargarProductos('');

        

        // $(window).on('scroll', function() {
        //     if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        //         loadMoreProducts();
        //     }
        // });

        // function loadMoreProducts() {
        //     if (nextPageUrl) {
        //         $('#load-more-btn').text('Cargando...');
        //         $.ajax({
        //             url: nextPageUrl,
        //             method: 'GET',
        //             success: function(response) {
        //                 $('#products-container').append(response);
        //                 nextPageUrl = $(response).filter('a[rel="next"]').attr('href');
        //                 if (!nextPageUrl) {
        //                     $('#load-more-btn').remove();
        //                 }
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error('Error al cargar más productos:', error);
        //             }
        //         });
        //     }
        // }

        // $('#load-more-btn').on('click', function() {
        //     loadMoreProducts();
        // });
      });


  </script>
</body>
</html>