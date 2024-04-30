@extends('dashboard.body.main')

@section('specificpagestyles')
    <link   rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link   rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link   href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Agregar producto</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <!-- begin: Input Image -->
                        {{-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% PRECIOS %%%%%%%%%%%%%%%%%%%%%%%%% --}}

                        <div class=" row align-items-center">
                            <div class="form-group col-md-3">
                                <label for="product_name">Nombre del producto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                                @error('product_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="category_id">Categoría <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" required>
                                    <option selected="" disabled>-- Selecciona una categoria --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="almacen_id">Almacen <span class="text-danger">*</span></label>
                                <select class="form-control" name="almacen_id" required>
                                    <option selected="" disabled>-- Seleccionar proveedor --</option>
                                    @foreach ($almacens as $almacen)
                                        <option value="{{ $almacen->id }}" {{ old('almacen_id') == $almacen->id ? 'selected' : '' }}>{{ $almacen->almacen }}</option>
                                    @endforeach
                                </select>
                                @error('almacen_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="marca_id">Marca <span class="text-danger">*</span></label>
                                <select class="form-control" name="marca_id" required>
                                    <option selected="" disabled>-- Seleccionar marca --</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>{{ $marca->marca }}</option>
                                    @endforeach
                                </select>
                                @error('marca_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="buying_price">Precio compra <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('buying_price') is-invalid @enderror" id="buying_price" name="buying_price" value="{{ old('buying_price') }}100" required>
                                @error('buying_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="precio1">Precio1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('precio1') is-invalid @enderror" id="precio1" name="precio1" value="{{ old('precio1') }}150" required>
                                @error('precio1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="precio2">Precio2 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('precio2') is-invalid @enderror" id="precio2" name="precio2" value="{{ old('precio2') }}150" required>
                                @error('precio2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                         
                            <div class="form-group col-md-2">
                                <label for="precio3">Precio3 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('precio3') is-invalid @enderror" id="precio3" name="precio3" value="{{ old('precio3') }}200" required>
                                @error('precio3')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="precio4">Precio4 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('precio4') is-invalid @enderror" id="precio4" name="precio4" value="{{ old('precio4') }}250" required>
                                @error('precio4')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                         {{-- %%%%%%%%%%%%%%%%%%%%%%%%%% FIN PRECIOS --}}
                           
                        <input id="input-id" name="fotos[]" type="file" class="file" data-preview-file-type="text" multiple>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                            <a class="btn bg-danger" href="{{ route('products.index') }}">Calcelar</a>
                        </div>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/buffer.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/filetype.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/locales/fr.js"></script>


{{-- agregando funcionalidades a bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $(document).ready(function() {
       
        $("#input-id").fileinput(
        {
            maxFileCount: 5,
            showUpload: false,
        });
    })
    
    $('#buying_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
    $('#expire_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
</script>

@include('components.preview-img-form')
@endsection
