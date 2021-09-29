@extends('adminlte::page')
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Houve alguns problemas com sua entrada de informações.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert"><span class="fas fa-close"></span></button>
            <strong>{{ $message }}</strong>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informações complementares</h3>
                </div>

                <form action="{{ isset($address) ? url('user_address', $address->id) : url('user_address') }}" method="POST">
                    @csrf
                    @if(isset($address))
                        @method('PATCH')
                    @else
                        @method('POST')
                    @endif

                    <div class="card-body">
                        <div class="form-group">
                            <label for="zip_code">CEP</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code"  value="{{ isset($address) ? $address->zip_code:'' }}" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="address">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ isset($address) ? $address->address:'' }}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="number">Número</label>
                            <input type="text" class="form-control" id="number" name="number" value="{{ isset($address) ? $address->number:'' }}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ isset($address) ? $address->neighborhood:'' }}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="city">Cidade</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ isset($address) ? $address->city:'' }}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="state">Estado</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ isset($address) ? $address->state:'' }}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="country">Pais</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ isset($address) ? $address->country:'' }}" placeholder="">
                        </div>

                    </div>

                    <div class="card-footer">
                        @if(isset($address))
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        @else
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        @endif
                    </div>
              </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/zip_code.js') }}"></script>
@endsection
