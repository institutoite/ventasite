<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vista de Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Estilos personalizados para la vista de producto en PC */
    .product-container {
      display: flex;
    }

    .product-image-container {
      flex: 85%;
      position: relative;
    }

    .product-image-container img {
      width: 100%;
      height: auto;
      object-fit: contain;
    }

    .product-image-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      filter: blur(5px);
      z-index: -1;
    }

    .product-buttons {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      display: flex;
      justify-content: space-between;
    }

    .product-button {
      background-color: #007bff;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .product-details-container {
      flex: 15%;
      padding-left: 20px;
    }

    .product-name {
      font-size: 24px;
      font-weight: bold;
    }

    .product-price {
      font-size: 18px;
      color: #007bff;
    }

    .product-share-button {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container mt-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="product-container">
          <div class="product-image-container">
            <img src="{{ asset('storage/products/'.$product->product_image) }}" alt="Producto 1">
            <div class="product-image-background" style="background-image: url('{{ asset('storage/products/'.$product->product_image) }}');"></div>
            <div class="product-buttons">
              <button class="product-button">Anterior</button>
              <button class="product-button">Siguiente</button>
            </div>
          </div>
          <div class="product-details-container">
            <h2 class="product-name">{{ $product->product_name }}</h2>
            <p class="product-price">Bs. {{ $product->precio1 }}</p>
            <button class="btn btn-primary product-share-button">Compartir</button>
            <div class="product-details">
              <!-- Detalles del producto -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
