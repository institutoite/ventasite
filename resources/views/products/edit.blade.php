@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Product</h4>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ str_replace('validation.', '', $error) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('products.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <!-- begin: Input Image -->
                        <div class=" row align-items-center">
                            <div class="form-group col-md-3">
                                <label for="product_name">Nombre del producto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ $producto->product_name }}" required>
                                @error('product_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="category_id">Categoría <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" required>
                                    <option disabled>-- Selecciona una categoría --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ isset($producto) && $producto->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                    <option disabled>-- Seleccionar almacén --</option>
                                    @foreach ($almacens as $almacen)
                                        <option value="{{ $almacen->id }}" {{ isset($producto) && $producto->almacen_id == $almacen->id ? 'selected' : '' }}>{{ $almacen->almacen }}</option>
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
                                    <option disabled>-- Seleccionar marca --</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}" {{ isset($producto) && $producto->marca_id == $marca->id ? 'selected' : '' }}>{{ $marca->marca }}</option>
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
                                <label for="buying_price">Precio1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('buying_price') is-invalid @enderror" id="buying_price" name="buying_price" value="{{ $producto->buying_price }}" required>
                                @error('buying_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="precio1">Precio1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('precio1') is-invalid @enderror" id="precio1" name="precio1" value="{{ $producto->precio1 }}" required>
                                @error('precio1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="precio2">Precio2 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('precio2') is-invalid @enderror" id="precio2" name="precio2" value="{{ $producto->precio2 }}" required>
                                @error('precio2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="precio3">Precio3 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('precio3') is-invalid @enderror" id="precio3" name="precio3" value="{{ $producto->precio3 }}" required>
                                @error('precio3')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="precio4">Precio4 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('precio4') is-invalid @enderror" id="precio4" name="precio4" value="{{ $producto->precio4 }}" required>
                                @error('precio4')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <img class="imagen rounded float-right img-fluid img-thumbnail" src="{{ asset('storage/products/'.$producto->product_image) }}" alt="" >
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <img class="imagen rounded float-right img-fluid img-thumbnail" src="{{ asset('storage/products/'.$producto->imagen2) }}" alt="" >
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <img class="imagen rounded float-right img-fluid img-thumbnail" src="{{ asset('storage/products/'.$producto->imagen3) }}" alt="" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" id="product_image" name="product_image">
                                    <label for="foto">foto</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" id="imagen2" name="imagen2">
                                    <label for="foto">foto</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" id="imagen3" name="imagen3">
                                    <label for="foto">foto</label>
                                </div>
                            </div>
                        </div>


                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <a class="btn bg-danger" href="{{ route('products.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/LANG.js"></script>

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
        // https://gijgo.com/datetimepicker/configuration/format
    });
    $('#expire_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
        // https://gijgo.com/datetimepicker/configuration/format
    });
</script>

@include('components.preview-img-form')
@endsection

{{-- 
    
<div class="form-group row align-items-center">
                            <div class="col-md-12">
                                <div class="profile-img-edit">
                                    <div class="crm-profile-img-edit">
                                        <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/images/product/default.webp') }}" alt="profile-pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-4 col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('product_image') is-invalid @enderror" id="image" name="product_image" accept="image/*" onchange="previewImage();">
                                    <label class="custom-file-label" for="product_image">Choose file</label>
                                </div>
                                @error('product_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Image -->
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                            <div class="form-group col-md-12">
                                <label for="product_name">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
                                @error('product_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" required>
                                    <option selected="" disabled>-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="supplier_id">Supplier <span class="text-danger">*</span></label>
                                <select class="form-control" name="supplier_id" required>
                                    <option selected="" disabled>-- Select Supplier --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_garage">Product Garage</label>
                                <input type="text" class="form-control @error('product_garage') is-invalid @enderror" id="product_garage" name="product_garage" value="{{ old('product_garage', $product->product_garage) }}">
                                @error('product_garage')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_store">Product Store</label>
                                <input type="text" class="form-control @error('product_store') is-invalid @enderror" id="product_store" name="product_store" value="{{ old('product_store', $product->product_store) }}">
                                @error('product_store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="buying_date">Buying Date</label>
                                <input id="buying_date" class="form-control @error('buying_date') is-invalid @enderror" name="buying_date" value="{{ old('buying_date', $product->buying_date) }}" />
                                @error('buying_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="expire_date">Expire Date</label>
                                <input id="expire_date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date" value="{{ old('expire_date', $product->expire_date) }}" />
                                @error('expire_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="buying_price">Buying Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('buying_price') is-invalid @enderror" id="buying_price" name="buying_price" value="{{ old('buying_price', $product->buying_price) }}" required>
                                @error('buying_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="selling_price">Selling Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" required>
                                @error('selling_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>    
--}}