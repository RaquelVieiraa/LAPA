@if(isset($registro))
    <p>Essa página de postagem está <strong>{{ $registro->publicado ? 'publicada' : 'salva no rascunho' }}.</strong></p>
@endif
<div class="form-group">
    <label for="titulo">Título da Postagem*</label>
    <input class="form-control form-control-lg @error('titulo') is-invalid @enderror" type="text" name="titulo" value="{{ isset($registro->titulo) ? $registro->titulo : old('titulo') }}" placeholder="ex: Visita ao LAPA" autocomplete="titulo">
    @error('titulo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="descricao">Descrição*</label>
    <textarea rows="14" id="summernote" class="form-control form-control-lg @error('descricao') is-invalid @enderror" type="text" name="descricao" autocomplete="descricao">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="tipo_postagem">Selecione o tipo da postagem*</label>
    <select class="custom-select custom-select-lg @error('tipo_postagem') is-invalid @enderror" name="tipo_postagem" id="tipo_postagem" required autocomplete="tipo_postagem">
        @if(!isset($registro->tipo_postagem))
            <option hidden disabled selected value>Clique para selecionar o tipo da postagem</option>
        @endif
        @foreach($tipo_postagens as $tipo)
            @if((isset($registro->tipo_postagem) && $registro->tipo_postagem == $tipo) || old('tipo_postagem') == $tipo))
                <option selected value="{{ $tipo }}" selected>{{ $tipo }}</option>
            @else
                <option value="{{ $tipo}}">{{$tipo}}</option>
            @endif
        @endforeach
    </select>
     @error('tipo_postagem')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div id="dh" class="{{ isset($registro->tipo_postagem) ? ($registro->tipo_postagem == 'evento' ? 'show' : '') : '' }} {{ old('tipo_postagem') == $tipo ? 'show' : '' }} @error('data') show @enderror @error('hora') show @enderror">
    <div class="d-flex flex-row">
        <div class="form-group">
            <label for="data">Data(obrigatório para evento)</label>
            <input min="{{ date('Y-m-d', strtotime('tomorrow')) }}" class="form-control form-control-lg @error('data') is-invalid @enderror" type="date" name="data" value="{{ isset($registro->data) ? $registro->data : old('data') }}" autocomplete="data">
            @error('data')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="d-flex flex-row">
        <div class="form-group">
            <label for="hora">Hora(obrigatório para evento)</label>
            <input min="{{ date('H:i', strtotime('00:00')) }}" class="form-control form-control-lg @error('hora') is-invalid @enderror" type="time" name="hora" value="{{ isset($registro->hora) ? date('H:i', strtotime($registro->hora)) : old('hora') }}" placeholder="Digite a hora do evento">
            @error('hora')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<div class="form-group" id="radio-group-anexo">
    <label class="@error('tipo_anexo') is-invalid @enderror">Escolher origem da imagem anexa*</label><br>
    <input disabled type="radio" name="tipo_anexo" value="upload" id="upload-radio" {{ isset($registro) ? ($registro->tipo_anexo == 'upload' ? 'checked' : '') : ''}}>
    <label for="upload-radio">Enviar arquivo do dispositivo</label><br>
    <input type="radio" name="tipo_anexo" value="link_drive" id="drive-radio" {{ isset($registro) ? ($registro->tipo_anexo == 'link_drive' ? 'checked' : '') : '' }}>
    <label for="drive-radio">Link compartilhado do Google Drive</label><br>
    <input type="radio" name="tipo_anexo" value="link_web" id="web-radio" {{ isset($registro) ? ($registro->tipo_anexo == 'link_web' ? 'checked' : '') : '' }}>
    <label for="web-radio">Link da imagem da web</label>
    @error('tipo_anexo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group form-group-anime {{ isset($registro) ? 'show' : '' }}">
    <label id="upload" class="file-input w-100 input-anime {{ isset($registro) ? ($registro->tipo_anexo == 'upload' ? 'show' : '') : '' }}" for="anexo">
        <div class="d-flex flex-column text-center border rounded bg-white">
            <div class="file-header">
                <img height="200px" id="img-foto" src="{{ asset($registro->anexo ?? asset('img/file-image.svg')) }}" alt="" style="max-height: 200px">
            </div>
            <div class="file-label">
                <p>Escolher uma imagem jpeg, jpg, png ou gif.</p>
            </div>
        </div>
        <input id="anexo" class="d-none form-control form-control-lg @error('anexo') is-invalid @enderror" type="file" name="anexo_upload" placeholder="Escolha um arquivo jpeg, jpg, png ou gif" onchange="document.getElementById('img-foto').src = window.URL.createObjectURL(this.files[0])">
    </label>
    <div id="link_drive" class="drive-input input-anime {{ isset($registro) ? ($registro->tipo_anexo == 'link_drive' ? 'show' : '') : '' }}">
        <label>Link da imagem do Google Drive*</label>
        <input type="text" class="form-control form-control-lg @error('anexo') is-invalid @enderror" name="anexo_drive" placeholder="A imagem deve ser no formato jpeg, jpg, png ou gif." value="{{ isset($registro->anexo) ? $registro->anexo : old('anexo') }}">
        <p class="info">*O link é obtido na opção "Gerar link compartilhável" pelo Google Drive e deve ter a permissão "Visível a qualquer pessoa com link".</p>
    </div>
    <div id="link_web" class="web-link-input input-anime {{ isset($registro) ? ($registro->tipo_anexo == 'link_web' ? 'show' : '') : '' }}">
        <label>Link da imagem da web</label>
        <input type="text" class="form-control form-control-lg @error('anexo') is-invalid @enderror" name="anexo_web" placeholder="A imagem deve ser no formato jpeg, jpg, png ou gif." value="{{ isset($registro->anexo) ? $registro->anexo : old('anexo') }}">
    </div>

    @error('anexo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@section('scripts')
    <script>        
        document.getElementById("tipo_postagem").addEventListener("change", function() {
            if(this.value === "evento"){
                document.getElementById("dh").classList.add("show");
            } else {
                document.getElementById("dh").classList.remove("show");
            }
        });
    </script>

    <!-- Script de mostrar/esconder campos de anexos -->
    <script src="{{ asset('js/toggle_anexo_input.js') }}"></script>
@endsection
