@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Importar producto</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.importStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                             
                            <div class="input-group mb-4 col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('upload_file') is-invalid @enderror" id="upload_file" name="upload_file" onchange="showFileName();">
                                    <label class="custom-file-label" for="upload_file" id="label_input">Eleja el archivo (.xls / .xlsx)</label>
                                </div>
                               
                                @error('upload_file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                              <div class="input-group mb-4 col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('upload_file') is-invalid @enderror" id="upload_zip" name="upload_zip" onchange="showFileName();">
                                    <label class="custom-file-label" for="upload_zip" id="label_input">Eleja el archivo (.zip)</label>
                                </div>
                               
                                @error('upload_zip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Importar</button>
                            <a class="btn bg-danger" href="{{ route('products.index') }}">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

<script>
function showFileName() {
    const input = document.getElementById('upload_file');
    const label_input = document.getElementById('label_input');

    // the change event gives us the input it occurred in
    const srcFile = input.srcElement;

    // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    var fileName = input.files[0].name;

    label_input.innerHTML = fileName;
}
</script>

@endsection

{{-- @extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Importar producto</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.importStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="input-group mb-4 col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('upload_file') is-invalid @enderror" id="upload_file" name="upload_file" onchange="showFileName();">
                                    <label class="custom-file-label" for="upload_file" id="label_input">Eleja el archivo (.xls / .xlsx)</label>
                                </div>
                                @error('upload_file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button class="btn btn-primary mr-2">Importar</button>
                            <a class="btn bg-danger" href="{{ route('products.index') }}">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Page end  -->
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

<script>
function showFileName() {
    const input = document.getElementById('upload_file');
    const label_input = document.getElementById('label_input');

    // the change event gives us the input it occurred in
    const srcFile = input.srcElement;

    // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    var fileName = input.files[0].name;

    label_input.innerHTML = fileName;
}


    $(document).ready(function(){
        $('#btnSubir').click(function(e){
    e.preventDefault();
    var file = $('#upload_file')[0].files[0];
    if (!file) {
        alert('Por favor selecciona un archivo Excel.');
        return;
    }



      // Obtener la dirección de la imagen
var imagenDireccion = "D:\\IMAGENES\\MASEROJO1\\MTA1200.jpg";

// Crear un nuevo elemento <img>
var $imagen = $('<img>');

// Asignar la dirección de la imagen al atributo src del elemento <img>
$imagen.attr('src', 'file://' + imagenDireccion);

// Agregar el elemento <img> al DOM, por ejemplo, al cuerpo del documento
$('#conte').append($imagen);



    var reader = new FileReader();
    reader.onload = function(e) {
        var data = new Uint8Array(e.target.result);
        var workbook = XLSX.read(data, {type: 'array'});
        var sheetName = workbook.SheetNames[0]; // Suponemos que la hoja de cálculo está en la primera pestaña
        
        // Obtener la hoja de cálculo
        var sheet = workbook.Sheets[sheetName];

        // Convertir la hoja de cálculo a JSON
        var jsonData = XLSX.utils.sheet_to_json(sheet, {header:1});
        //console.log(jsonData);
        // Verificar si hay datos
        if (jsonData.length === 0) {
            console.log('El archivo Excel está vacío.');
        } else {
            // Iterar sobre los datos del archivo Excel
            for (var i = 1; i < jsonData.length; i++) { // Empezamos en 1 para omitir el encabezado
                var nombreProducto = jsonData[i][0]; // La primera columna (0) es el nombre del producto
                var direccionFoto = jsonData[i][1]; // La segunda columna (1) es la dirección de la foto
                // console.log('Nombre del producto:', nombreProducto);
                // console.log('Dirección de la foto:', direccionFoto);
                
                var formData = new FormData();
                formData.append('nombreProducto', nombreProducto);
                formData.append('imagenProducto', direccionFoto);
                leerYSubirImagen(nombreProducto, direccionFoto);
                // Aquí puedes realizar cualquier otra acción con los datos, como enviarlos al servidor mediante AJAX
            }
        }
    };
    reader.readAsArrayBuffer(file);
});

    });


    function leerYSubirImagen(nombreProducto, direccionFoto) {
    var reader = new FileReader();
        reader.onload = function(e) {
            var blob = new Blob([e.target.result], { type: "image/jpeg" }); // Cambia el tipo MIME según sea necesario
            var formData = new FormData();
            formData.append('nombreProducto', nombreProducto);
            formData.append('imagenProducto', blob, nombreProducto + '.jpg'); // Cambia el nombre del archivo según sea necesario
            //console.log(formData);
            
            // Realizar una llamada AJAX para enviar los datos al servidor
            //enviarDatosAlServidor(formData);
        };
        
    // Convertir la dirección de la imagen local a un archivo
    var imgFile = new File([direccionFoto], direccionFoto.split('/').pop());
    console.log(imgFile);
    reader.readAsArrayBuffer(imgFile);
}

function enviarDatosAlServidor(formData) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '../guardar/productudo', // Reemplaza esto con la URL de tu endpoint en el servidor
        method: 'POST',
        data: formData,
        processData: false,  // Evitar que jQuery procese los datos automáticamente
        contentType: false,  // Evitar que jQuery establezca automáticamente el tipo de contenido
        headers: {
                'X-CSRF-TOKEN': csrfToken // Incluir el token CSRF en los encabezados de la solicitud
            },
        success: function(response) {
            console.log('Datos enviados al servidor:', response);
        },
        error: function(xhr, status, error) {
            console.error('Error al enviar los datos al servidor:', error);
        }
    });
}

</script>

@endsection --}}
