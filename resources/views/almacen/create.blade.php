@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Crear Almacen</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('almacens.store') }}" method="POST">
                    @csrf
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                            <div class="form-group col-md-12">
                                <label for="almacen">almacen <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('almacen') is-invalid @enderror" id="almacen" name="almacen" value="{{ old('almacen') }}" required>
                                @error('almacen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                            <a class="btn bg-danger" href="{{ route('almacens.index') }}">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
@include('components.preview-img-form')
@endsection
