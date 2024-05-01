@extends('dashboard.body.main')

@section('specificpagestyles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
@endsection

@section('container')
    <div class="card">
        <div class="card-header">
            {{-- <div class="container">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Crear</a>
            </div> --}}
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
        <div class="card-body">
            <table id="productos" class="table table-bordered tabla-hover table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Almacen</th>
                        {{-- <th>Marca</th>
                        <th>Categoria</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr id="{{ $producto->id }}">
                            <td>{{ $producto->id }}</td>
                            <td><img class="crm-profile-pic rounded-circle avatar-100" src="{{ $producto->product_image ? asset('storage/products/'.$producto->product_image) : asset('assets/images/product/default.webp') }}"></td>
                            <td>{{ $producto->product_code }}</td>
                            <td>{{ $producto->product_name }}</td>
                            <td><strong>{{ $producto->precio1 }}Bs.</strong></td>
                            <td>{{ $producto->almacen->almacen }}</td>
                            {{-- <td>{{ $producto->marca->marca }}</td>
                            <td>{{ $producto->category->name }}</td> --}}
                            <td>
                                
                                <form action="{{ route('products.destroy', $producto->id) }}" method="POST" style="margin-bottom: 5px">
                                    @method('delete')
                                    @csrf
                                    <div class="d-flex align-items-center list-action">
                                        <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                            href="{{ route('products.show', $producto->id) }}"><i class="ri-eye-line mr-0"></i>
                                        </a>
                                        @can('editar.producto', $producto)
                                            <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                href="{{ route('products.edit', $producto->id) }}"><i class="ri-pencil-line mr-0"></i>
                                            </a>
                                        @endcan
                                        @if ($producto->estado)
                                            <button type="submit" class="btn btn-warning mr-2 border-none" onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ri-delete-bin-line mr-0"></i></button>
                                        @else
                                            <a class="btn daralta"><i class="fa-solid fa-circle-up fa-beat-fade fa-2x text-success"></i></a>
                                        @endif
                                    </div>
                                    
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
@section('specificpagescripts')
  {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

 <script>
    $(document).ready(function() {
        $('#productos').DataTable({
        });

        $("table").on("click",".daralta",function(e){
            e.preventDefault();
            let id = $(this).closest("tr").attr("id");
            console.log(id);
            $.ajax({
                url : "{{ route('producto.dar.alta') }}",
                data : { id :  id},
                type : 'GET',
                dataType : 'json',
                success : function(json) {
                    console.log(json);
                    window.location.reload();
                },
                error : function(xhr, status) {
                    alert('Disculpe, existió un problema');
                },
            }); 
        });
    });
 </script>
@endsection

