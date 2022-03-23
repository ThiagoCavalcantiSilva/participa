@extends('coordenador.detalhesEvento')

@section('menu')

    <div id="divCadastrarAssinatura" class="comissao">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="titulo-detalhes">Editar Certificado</h1>
                <h6 class="card-subtitle mb-2 text-muted">Edite um modelo de certificado</h6>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <form id="formCadastrarCertificado" action="{{route('coord.certificado.update', ['id' => $certificado->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="eventoId" value="{{$evento->id}}">
            <div class="form-row">
                <div class="col-sm-12 form-group">
                    <label for="nome"><b>{{ __('Nome') }}</b></label>
                    <input id="nome" class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{old('nome')!=null ? old('nome') : $certificado->nome}}" required autofocus autocomplete="nome">

                    @error('nome')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-sm-6 form-group">
                    <label for="texto"><b>{{ __('Texto') }}</b></label>
                    <textarea id="texto" class="form-control @error('texto') is-invalid @enderror" type="text" name="texto" value="{{old('texto')}}" required autofocus autocomplete="texto">{{$certificado->texto}}</textarea>

                    @error('texto')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="local"><b>{{ __('Local') }}</b></label>
                        <input id="local" class="form-control @error('local') is-invalid @enderror" type="text" name="local" value="{{old('local')!=null ? old('local') : $certificado->local}}" required autofocus autocomplete="local">

                        @error('local')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        Tags que podem ser utilizadas para recuperar informações no certificado: <br>
                        %NOME_PESSOA% para preencher o nome da pessoa que está sendo certificada <br>
                        %CPF% para preencher o CPF da pessoa que está sendo certicidada <br>
                        %TITULO_TRABALHO% para preencher o título do trabalho do autor ou coautor <br>
                        %NOME_EVENTO% para preencher o nome do evento <br>
                        %TITULO_PALESTRA% para preencher o título da palestra do palestrante <br>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-6 form-group">
                    <label for="tipo"><b>{{__('Tipo')}}</b></label>
                    <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                        <option @if($certificado->tipo == \App\Models\Submissao\Certificado::TIPO_ENUM['apresentador']) selected @endif value="{{\App\Models\Submissao\Certificado::TIPO_ENUM['apresentador']}}">Apresentador</option>
                        <option @if($certificado->tipo == \App\Models\Submissao\Certificado::TIPO_ENUM['comissao_cientifica']) selected @endif value="{{\App\Models\Submissao\Certificado::TIPO_ENUM['comissao_cientifica']}}">Membro da comissão Científica</option>
                        <option @if($certificado->tipo == \App\Models\Submissao\Certificado::TIPO_ENUM['coordenador_comissao_cientifica']) selected @endif value="{{\App\Models\Submissao\Certificado::TIPO_ENUM['coordenador_comissao_cientifica']}}">Coordenador da Comissão Científica</option>
                        <option @if($certificado->tipo == \App\Models\Submissao\Certificado::TIPO_ENUM['comissao_organizadora']) selected @endif value="{{\App\Models\Submissao\Certificado::TIPO_ENUM['comissao_organizadora']}}">Membro da Comissão Organizadora</option>
                        <option @if($certificado->tipo == \App\Models\Submissao\Certificado::TIPO_ENUM['expositor']) selected @endif value="{{\App\Models\Submissao\Certificado::TIPO_ENUM['expositor']}}">Expositor</option>
                        <option @if($certificado->tipo == \App\Models\Submissao\Certificado::TIPO_ENUM['participante']) selected @endif value="{{\App\Models\Submissao\Certificado::TIPO_ENUM['participante']}}">Participante</option>
                        <option @if($certificado->tipo == \App\Models\Submissao\Certificado::TIPO_ENUM['revisor']) selected @endif value="{{\App\Models\Submissao\Certificado::TIPO_ENUM['revisor']}}">Revisor</option>
                    </select>

                    @error('tipo')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-sm-6 form-group">
                    <label for="data" ><b>{{ __('Data') }}</b></label>
                    <input id="data" type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="@if(old('data')!=null){{old('data')}}@else{{date('Y-m-d',strtotime($certificado->data))}}@endif"  autocomplete="data" autofocus autocomplete="data">

                    @error('data')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-12 form-group">
                    <label for="assinatura"><b>{{ __('Assinaturas') }}</b></label>
                    <input type="hidden" class="checkbox_assinatura @error('assinaturas') is-invalid @enderror">
                    <div class="row cards-eventos-index">
                        @foreach ($assinaturas as $assinatura)
                            <div class="card" style="width: 16rem;">
                                <img class="img-card" src="{{asset('storage/'.$assinatura->caminho)}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="card-title">
                                                <div class="row">
                                                    <div class="form-check">
                                                        <input class="checkbox_assinatura" type="checkbox" name="assinaturas[]" value="{{$assinatura->id}}" id="assinatura_{{$assinatura->id}}">
                                                        {{$assinatura->nome}}
                                                    </div>
                                                </div>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('assinaturas')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-12 form-group">
                    <label for="fotoCertificado"><b>Certificado</b></label>
                    <div id="imagem-loader" class="imagem-loader">
                        @if ($certificado->caminho != null)
                            <img id="logo-preview" src="{{asset('storage/'.$certificado->caminho)}}" alt="">
                        @else
                            <img id="logo-preview" src="{{asset('/img/nova_imagem.PNG')}}" alt="">
                        @endif
                    </div>
                    <div style="display: none;">
                        <input type="file" id="logo-input" accept="image/*" class="form-control @error('fotoCertificado') is-invalid @enderror" name="fotoCertificado" value="{{ old('fotoCertificado') }}">
                    </div>
                    <small style="position: relative; top: 5px;">Tamanho minimo: 1024 x 425;<br>Formato: JPEG, JPG, PNG</small>
                    <br>
                    @error('fotoCertificado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" style="width:100%">
                        {{ __('Editar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('javascript')
    @parent
    <script type="text/javascript" >
        $(document).ready(function($){
            CKEDITOR.replace('texto');
            $('#imagem-loader').click(function() {
                $('#logo-input').click();
                $('#logo-input').change(function() {
                    if (this.files && this.files[0]) {
                        var file = new FileReader();
                        file.onload = function(e) {
                            document.getElementById("logo-preview").src = e.target.result;
                        };
                        file.readAsDataURL(this.files[0]);
                    }
                })
            });
        });
    </script>
@endsection
