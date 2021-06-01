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

                <form action="{{ isset($user) ? url('user/profile_update',auth()->user()->id) : url('user/profile') }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="card-body">
                        <div class="form-group">
                            <label for="rg">Rg</label>
                            <input type="text" class="form-control" id="rg" name="rg"  value="{{ isset($user) ? $user->rg:'' }}" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ isset($user) ? $user->cpf:'' }}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ isset($user) ? $user->phone:'' }}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="emergency_phone">Telefone de emergência</label>
                            <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" value="{{ isset($user) ? $user->emergency_phone:'' }}" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="blood_type">Tipo Sanguíneo</code></label>
                            <select class="custom-select form-control-border" id="blood_type" name="blood_type">
                                <option value=null>Selecione</option>
                                <option {{ isset($user) ? ($user->blood_type == "A+" ? 'selected':''):'' }}>A+</option>
                                <option {{ isset($user) ? ($user->blood_type == "A-" ? 'selected':''):'' }}>A-</option>
                                <option {{ isset($user) ? ($user->blood_type == "B+" ? 'selected':''):'' }}>B+</option>
                                <option {{ isset($user) ? ($user->blood_type == "B-" ? 'selected':''):'' }}>B-</option>
                                <option {{ isset($user) ? ($user->blood_type == "AB+" ? 'selected':''):'' }}>AB+</option>
                                <option {{ isset($user) ? ($user->blood_type == "AB-" ? 'selected':''):'' }}>AB-</option>
                                <option {{ isset($user) ? ($user->blood_type == "O+" ? 'selected':''):'' }}>O+</option>
                                <option {{ isset($user) ? ($user->blood_type == "O-" ? 'selected':''):'' }}>O-</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gênero</code></label>
                            <select class="custom-select form-control-border" id="gender" name="gender">
                                <option value="null">Selecione o gênero</option>
                                <option {{ isset($user) ? ($user->gender == "Masculino" ? 'selected':''):'' }}>Masculino</option>
                                <option {{ isset($user) ? ($user->gender == "Feminino" ? 'selected':''):'' }}>Feminino</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Possui alergia? Quais?</label>
                                <textarea
                                    class="form-control"
                                    rows="3" id="allergy"
                                    name="allergy"
                                    placeholder="Descreva suas alergias ou responda 'Não'">{{ isset($user) ? $user->allergy:'' }}</textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Possui problema de saúde? Quais?</label>
                                <textarea
                                class="form-control"
                                rows="3"
                                id="health_problem"
                                name="health_problem"
                                placeholder="Descreva seus problemas de saúde ou responda 'Não'">{{ isset($user) ? $user->health_problem:'' }}</textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Usa algum tipo de medicação? Quais</label>
                                <textarea
                                class="form-control"
                                rows="3" id="take_medication"
                                name="take_medication"
                                placeholder="Descreva seus medicamentos ou responda 'Não'">{{ isset($user) ? $user->take_medication:'' }}</textarea>
                            </div>
                        </div>

                        <div class="row shadow-sm bg-white rounded">
                            <div class="col-md-10 col-lg-8">
                                <div class="form-group">
                                    <label for="photo">Foto</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"  onchange="readURL(this);"  class="custom-file-input" name="photo" id="photo">
                                            <label class="custom-file-label" for="photo" data-browse="Carregar Foto"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 p-2">
                                <img class="float-right img-fluid img-thumbnail" src="{{ isset($user->photo) ? 'storage/photos/'.$user->photo : 'storage/photos/sem-foto.jpg'}}" id="img" style="max-width:180px; max-height:180px; display:none;">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        @if(isset($user))
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
<script src="{{ asset('js/preview.js') }}"></script>
@endsection
