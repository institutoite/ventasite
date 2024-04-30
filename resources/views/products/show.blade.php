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
                        <h4 class="card-title">Código de barras</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class=" row align-items-center">
                        <div class="form-group col-md-6">
                            <label>Código de producto</label>
                            <input type="text" class="form-control bg-white" value="{{  $product->product_code }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Código de barras del producto</label>
                            {!! $barcode !!}
                        </div>
                    </div>
                    <!-- end: Show Data -->
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Producto de información</h4>
                    </div>
                </div>

                <div class="card-body">
                    <!-- begin: Show Data -->
                   
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    MOSTRAR PRODUCTO {{ $product->product_name }}
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered table-striped">
                                        <tr>
                                          <th>PROPIEDAD</th>
                                          <th>VALOR</th>
                                        </tr>
                                        <tr>
                                          <th>Codigo</th>
                                          <td>{{ $product->product_code }}</td>
                                        </tr>
                                        <tr>
                                          <th>Nombre del producto</th>
                                          <td>{{ $product->product_name }}</td>
                                        </tr>
                                        <tr>
                                          <th>Categoría</th>
                                          <td>{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                          <th>Almacen</th>
                                          <td>{{ $product->almacen->almacen }}</td>
                                        </tr>
                                        <tr>
                                          <th>Marca</th>
                                          <td>{{ $product->marca->marca }}</td>
                                        </tr>
                                        
                                            @can('ver.preciocompra', $product)
                                                <tr>
                                                    <th>Precio Compra</th>
                                                    <td>{{ $product->buying_price }}</td>
                                                </tr>
                                            @endcan

                                        <tr>
                                          <th>Precio 1</th>
                                          <td>{{ $product->precio1 }}</td>
                                        </tr>
                                        <tr>
                                          <th>Precio 2</th>
                                          <td>{{ $product->precio2 }}</td>
                                        </tr>
                                        <tr>
                                          <th>Precio 3</th>
                                          <td>{{ $product->precio3 }}</td>
                                        </tr>
                                        <tr>
                                          <th>Precio 4</th>
                                          <td>{{ $product->precio4 }}</td>
                                        </tr>
                                      </table>
                                      
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row align-items-center">
                                <div class="col-md-12">
                                    <div class="profile-img-edit">
                                        <div class="crm-profile-img-edit">
                                            <img class="" id="image-preview" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/images/product/default.webp') }}" alt="profile-pic">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" row align-items-center">
                        <div class="form-group col-md-12">
                            <label>Nombre del producto</label>
                            <input type="text" class="form-control bg-white" value="{{  $product->product_name }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Categoría</label>
                            <input type="text" class="form-control bg-white" value="{{  $product->category->name }}" readonly>
                        </div>
                       
                        <div class="form-group col-md-6">
                            <label>Almacen</label>
                            <input type="text" class="form-control bg-white" value="{{  $product->almacen->almacen }}" readonly>
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label>Precio 1</label>
                            <input type="text" class="form-control bg-white" value="{{  $product->buying_price }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Precio 2</label>
                            <input type="text" class="form-control bg-white" value="{{  $product->precio2 }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>precio 3</label>
                            <input type="text" class="form-control bg-white" value="{{  $product->precio3 }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>precio 4</label>
                            <input type="text" class="form-control bg-white" value="{{  $product->precio4 }}" readonly>
                        </div>
                    </div>
                    
                    <!-- end: Show Data -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

<script>
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
