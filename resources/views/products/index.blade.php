@extends('dashboard.body.main')

@section('specificpagestyles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> --}}
@endsection

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Lista de productos</h4>
                    <p class="mb-0">
                        Un panel de productos mejora la experiencia simplificando la recopilación de datos.</p>
                </div>
                <div>
                <a href="{{ route('products.importView') }}" class="btn btn-success add-list">Importar</a>
                <a href="{{ route('products.exportData') }}" class="btn btn-warning add-list">Exportar</a>
                <a href="{{ route('products.create') }}" class="btn btn-primary add-list"><b>+ </b>producto</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('products.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">Fila:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">Buscar:</label>
                        <div class="input-group col-sm-8">
                            <input type="text" id="search" class="form-control" name="search" placeholder="Buscar producto" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20"></i></button>
                                <a href="{{ route('products.index') }}" class="input-group-text bg-danger"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>N°.</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($products as $product)
                            <tr id="{{ $product->id }}">
                                <td>{{ (($products->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                                <td>
                                    <img class="avatar-60 rounded" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/images/product/default.webp') }}">
                                </td>
                                <td>{{ $product->product_name }}x</td>
                                <td>{{ $product->category->name }}</td>
                                {{-- <td>{{ $product->supplier->name }}</td> --}}
                                <td>{{ $product->selling_price }}</td>
                                <td>
                                    @if ($product->expire_date > Carbon\Carbon::now()->format('Y-m-d'))
                                        <span class="badge rounded-pill bg-success">Válido</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Inválido</span>
                                    @endif
                                </td>
                                <td>
                                    

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="margin-bottom: 5px">
                                        @method('delete')
                                        @csrf
                                        <div class="d-flex align-items-center list-action">
                                            <a class="btn btn-info mr-2 agregarproducto">
                                                <i class="fa-regular fa-square-plus mr-0"></i>
                                            </a>

                                            <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href="{{ route('products.show', $product->id) }}"><i class="ri-eye-line mr-0"></i>
                                            </a>
                                            
                                            <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                href="{{ route('products.edit', $product->id) }}"><i class="ri-pencil-line mr-0"></i>
                                            </a>
                                                <button type="submit" class="btn btn-warning mr-2 border-none" onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ri-delete-bin-line mr-0"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>

                        @empty
                        <div class="alert text-white bg-danger" role="alert">
                            <div class="iq-alert-text">Datos no encontrador</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                            </button>
                        </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>


{{-- modal para agragar mas productos existentes --}}
<div class="modal fade" id="form_mas_productos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="titulo_modal">Proveyendo </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <input class="form-control" hidden type="number" name="product_id" id="product_id">
                <div class="input-group">
                    <input min="0" type="number" class="form-control" value="1" id="stock" placeholder="Ingrese cantidad">
                    <button class="btn btn-outline-secondary" type="button" id="incrementar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                    </button>
                    <button class="btn btn-outline-secondary" id="decrementar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </button>
                </div>
                
                <select class="form-select form-select-lg mb-3" id="sucursal_select" aria-label="Large select example">
                </select>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="guardando" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>


    <div id="products-container">
        @foreach ($products as $product)
            <!-- Mostrar información del producto -->
        @endforeach
    </div>

    @if ($products->hasMorePages())
        <button id="load-more-btn">Cargar más productos</button>
    @endif
@endsection
@section('specificpagescripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            let producto_id;
            function incrementCantidad(){
                cantidad_atual=parseInt($("#stock").val());
                $("#stock").val(cantidad_atual+1);
                console.log("incrementando");
            }
            function decrementCantidad(){
                cantidad_atual=parseInt($("#stock").val());
                if(cantidad_atual>0)
                    $("#stock").val(cantidad_atual-1);
                console.log("decrementando");
            }

            $("#incrementar").on("click",function(){
                incrementCantidad();
            })
            $("#decrementar").on("click",function(){
                decrementCantidad();
            })

            $("table").on("click",".agregarproducto",function(e){
                e.preventDefault();
                producto_id = $(this).closest("tr").attr("id");
                console.log(producto_id);
                
                $.ajax({
                    url: "{{ route('agregar.productos') }}",
                    method:"get",
                    data: {
                        producto_id: producto_id
                    },
                    success: function(data) {
                        console.log(data);
                        $("#titulo_modal").text("Probeyendo: "+data.product_name)
                        try {
                            $.ajax({
                                url: "{{ route('get.sucursales') }}", // La URL a la que se hará la solicitud
                                method: 'GET', // El método HTTP (en este caso, GET)
                                dataType: 'json', // El tipo de datos esperado en la respuesta (en este caso, JSON)
                                success: function(sucursales) {
                                    $("#sucursal_select").empty();
                                    $("#product_id").val(data);
                                    
                                    $("#sucursal_select").append(`<option>Elija una sucursal</option>`);
                                    sucursales.forEach(sucursal => {
                                        $("#sucursal_select").append(`<option value=${sucursal.id}>${sucursal.name}</option>`);
                                    });
                                },
                            });

                        } catch (error) {
                            // Si hay un error, maneja el error
                            console.error('Hubo un error al obtener las sucursales:', error);
                        }
                        $("#form_mas_productos").modal("show");
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            })
            $("#guardando").on("click",function(e){
                e.preventDefault();
                console.log("click guardando");
                $("#form_mas_productos").modal("hide");
                $.ajax({
                    url: "{{ route('agregar.productos.guardar') }}",
                    method:"post",
                    data: {
                        product_id: producto_id,
                        stock: $("#stock").val(),
                        sucursal_id: $("#sucursal_select").val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                        $("#form_mas_productos").modal("hide");
                        //location.reload();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        } );
    </script>
@endsection

