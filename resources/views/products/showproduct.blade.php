<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle del Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* Ajustes de estilo adicionales si es necesario */
    .product-info {
      padding: 20px;
    }

    .product-info h2 {
      margin-top: 0;
    }

    .product-info .price {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .product-info .share-icon {
      color: #007bff;
      font-size: 24px;
      margin-right: 10px;
    }
    .btn-buy{
      width: 100%;
    }

    .product-info .product-description {
      font-size: 14px;
      color: #666;
    }
    .product-link {
      color: inherit; /* Heredar el color del texto */
      text-decoration: none; /* Quitar la subrayado del enlace */
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

  </style>
</head>
<body>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-8">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{ asset('storage/products/'.$product->product_image) }}" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset('storage/products/'.$product->imagen2) }}" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{ asset('storage/products/'.$product->imagen3) }}" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-info">
          <h2>{{ $product->product_name }} </h2>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{ $product->category->name }}</li>
              <li class="list-group-item">{{ $product->marca->marca }}</li>
              <li class="list-group-item">Bs. {{ $product->precio1 }}</li>
              <li class="list-group-item">{{ $product->category->telefono }}
                <a href="https://wa.me/591{{$product->category->telefono}}.'?text='.route('show.product.public',$product->id)" target="_blank" rel="noopener noreferrer">
                  <i class="fa-brands fa-whatsapp fa-beat fa-2x" style="color: #00fa60;"></i>
                </a>
              </li>
             
            </ul>
            
          </p>
        
          <p class="product-description">{{ $product->descripcion }}</p>
          <a href="https://wa.me/591{{$product->category->telefono}}?text={{str_replace(' ', '%20', $product->descripcion." Bs. ".$product->precio1." ".route('show.product.public',$product->id))}}" target="_blank" class="btn btn-success btn-buy">Enviar</a>
        </div>
        <h6>producto relacionado</h6>
        
        
        @isset($productosimilar)
            <div class="col-12 mb-0"> 
              <a href="{{ route("show.product.public",$productosimilar->id) }}" class="product-link"> <!-- Enlace para toda la tarjeta -->
                <div class="product-card">
                    <img class="d-block w-100" src="{{ asset('storage/products/'.$productosimilar->product_image) }}" alt="Producto 1">
                    <div class="card-body">
                        <p class="price mb-0">Bs. {{ $productosimilar->precio1 }} <span>{{ $productosimilar->product_name }}</span></p> 
                        <h5 class="description">{{ $productosimilar->descripcion }}</h5>
                      </div>
                    </div>
                  </a>
            </div>
          @else
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>No hay productos!</strong> Similares.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endisset
        </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
