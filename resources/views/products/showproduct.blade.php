<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle del Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Estilos para la vista de detalle del producto en PC */
 
    .product-detail-container {
      display: flex;
      flex-direction: row;
    }

    .product-detail-container .left-section {
      flex: 0 0 85%; /* 85% del ancho total */
      position: relative;
      overflow: hidden;
      aspect-ratio: 1; /* Hace que la sección izquierda sea cuadrada */
    }

    .product-detail-container .left-section .image-container {
      width: 80%;
      height: 80%; /* Hace que la imagen de fondo desenfocada ocupe todo el contenedor */
      position: relative;
      align-content: center;
    }

    .product-detail-container .left-section img {
      width: 100%; /* La imagen principal ocupa todo el contenedor */
      height: auto;
      position: absolute;
      top: 0;
      left: 0;
      object-fit: contain; /* Para que la imagen no se estire */
    }

    .product-detail-container .left-section .blur-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      filter: blur(15px);
      z-index: -1;
    }

    .product-detail-container .left-section .image-buttons {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding: 0 20px;
    }

    .product-detail-container .right-section {
      flex: 0 0 15%; /* 15% del ancho total */
      padding: 20px;
    }

    .product-detail-container .right-section h2 {
      margin-top: 0;
    }

    .product-detail-container .right-section .price {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .product-detail-container .right-section .share-icon {
      color: #007bff;
      font-size: 24px;
      margin-right: 10px;
    }

    .product-detail-container .right-section .product-description {
      font-size: 14px;
      color: #666;
    }

    /*css */
    #image-container {
      width: 400px; /* Ancho del contenedor */
      height: 300px; /* Altura del contenedor */
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden; /* Para recortar la imagen si es más grande que el contenedor */
    }

    #image-container img {
      max-width: 100%; /* Ancho máximo de la imagen */
      max-height: 100%; /* Altura máxima de la imagen */
      height: auto; /* Para mantener la proporción de la imagen */
      width: auto; /* Para mantener la proporción de la imagen */
    }

    .horizontal {
      height: 100%; /* El alto es proporcional */
    }

    .vertical {
      width: 100%; /* El ancho es proporcional */
    }


  </style>
</head>
<body>
  <div class="container mt-4">
    <div class="product-detail-container">
      <div class="left-section">
        <div class="image-container">
          <img id="product-image" src="{{ asset('storage/products/'.$product->product_image) }}" alt="Producto">
        </div>
        <div class="blur-background" style="background-image: url('{{ asset('storage/products/'.$product->product_image) }}');"></div>
        <div class="image-buttons">
          <button class="btn btn-primary" onclick="previousImage()">Anterior</button>
          <button class="btn btn-primary" onclick="nextImage()">Siguiente</button>
        </div>
      </div>
      <div class="right-section">
        <h2>Nombre del Producto</h2>
        <p class="price">Precio: $100</p>
        <button class="btn btn-link share-icon"><i class="fa-solid fa-share-nodes"></i></button>
        <p class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vehicula magna eget ex fermentum, vel tempus est varius.</p>
      </div>
    </div>
  </div>

  <script>
    var images = [
      "{{ asset('storage/products/'.$product->product_image) }}", // Imagen principal
      "{{ asset('storage/products/'.$product->imagen2) }}", // Segunda imagen del producto
      "{{ asset('storage/products/'.$product->imagen3) }}" // Tercera imagen del producto
    ];
    var currentImageIndex = 0;
    var productImage = document.getElementById('product-image');

    function nextImage() {
      currentImageIndex = (currentImageIndex + 1) % images.length;
      productImage.src = images[currentImageIndex];
      document.querySelector('.blur-background').style.backgroundImage = "url('" + images[currentImageIndex] + "')";
    }

    function previousImage() {
      currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
      productImage.src = images[currentImageIndex];
      document.querySelector('.blur-background').style.backgroundImage = "url('" + images[currentImageIndex] + "')";
    }

    window.addEventListener('load', function() {
      var imagen = document.getElementById('product-image');
      var contenedor = document.getElementById('image-container');

      imagen.onload = function() {
        var width = imagen.width;
        var height = imagen.height;

        if (width >= height) {
          contenedor.classList.add('horizontal');
        } else {
          contenedor.classList.add('vertical');
        }
      }
    });
  </script>
</body>
</html>
