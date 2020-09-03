@if(isset($registro))
    <p>Essa página do atlas está <strong>{{ $registro->publicado ? 'publicada' : 'salva no rascunho' }}.</strong></p>
@endif

<div class="form-group">
    <label for="titulo">Título da página do atlas*</label>
    <input class="form-control form-control-lg @error('titulo') is-invalid @enderror" type="text" name="titulo" value="{{ isset($registro->titulo) ? $registro->titulo : old('titulo') }}" placeholder="Mínimo de 5 caracteres">
    @error('titulo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="descricao">Descrição da página*</label>
    <textarea rows="14" id="summernote" class="form-control form-control-lg @error('descricao') is-invalid @enderror" type="text" name="descricao"  required autocomplete="descricao">{{ isset($registro->descricao) ? $registro->descricao : old('descricao') }}</textarea>
    @error('descricao')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="categoria_id">Selecione a área de conhecimento*</label>
    <select class="custom-select custom-select-lg @error('categoria_id') is-invalid @enderror" name="categoria_id" id="categorias">
        <option hidden disabled selected value>{{ __('Selecione uma área de conhecimento') }}</option>
        @foreach($categorias as $categoria)
            @if(isset($registro->categoria->id) && $categoria->id == $registro->categoria->id)
                <option value="{{ $categoria->id }}" selected>{{ ucfirst($categoria->nome) }}</option>
            @else
                <option value="{{ $categoria->id }}">{{ ucfirst($categoria->nome) }}</option>
            @endif
        @endforeach
    </select>
    @error('categoria_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group" id="radio-group-anexo">
    <label>Escolher origem da imagem anexa*</label><br>
    <input type="radio" name="tipo_anexo" value="upload" id="upload-radio" {{ isset($registro) ? ($registro->tipo_anexo == 'upload' ? 'checked' : '') : ''}}>
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

<div class="form-group">
    <label id="upload" class="file-input w-100" style="{{ isset($registro) ? ($registro->tipo_anexo == 'upload' ? 'display: block' : 'display: none') : 'display: none' }}" for="anexo">
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
    <div id="link_drive" class="drive-input" style="{{ isset($registro) ? ($registro->tipo_anexo == 'link_drive' ? 'display: block' : 'display: none') : 'display: none' }}">
        <label>Link da imagem do Google Drive*</label>
        <input type="text" class="form-control form-control-lg @error('anexo') is-invalid @enderror" name="anexo_drive" placeholder="A imagem deve ser no formato jpeg, jpg, png ou gif." value="{{ isset($registro->anexo) ? $registro->anexo : old('anexo') }}">
        <p class="info">*O link é obtido na opção "Gerar link compartilhável" pelo Google Drive e deve ter a permissão "Visível a qualquer pessoa com link".</p>
    </div>
    <div id="link_web" class="web-link-input" style="{{ isset($registro) ? ($registro->tipo_anexo == 'link_web' ? 'display: block' : 'display: none') : 'display: none' }}">
        <label>Link da imagem da web</label>
        <input type="text" class="form-control form-control-lg @error('anexo') is-invalid @enderror" name="anexo_web" placeholder="A imagem deve ser no formato jpeg, jpg, png ou gif." value="{{ isset($registro->anexo) ? $registro->anexo : old('anexo') }}">
    </div>	   
    @error('anexo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <p>Área de conhecimento não cadastrada? <a class="" href="{{ route('auth.categoria.adicionar') }}">{{ __('Cadastrar Área de conhecimento') }}</a>.</p>
</div>