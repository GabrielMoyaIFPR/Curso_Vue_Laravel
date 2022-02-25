{{ $slot }}
<form action={{ route('site.contato') }} method="post">
    @csrf
    <input name="nome" type="text" value="{{ old('nome')}}" placeholder="Nome" class="{{ $classe }}">
    <br>
    <input name="telefone" type="text" value="{{ old('telefone')}}" placeholder="Telefone" class="{{ $classe }}">
    <br>
    <input name="email" type="text" value="{{ old('email')}}" placeholder="E-mail" class="{{ $classe }}">
    <br>

    <select name="motivo_contato" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>
        @foreach($motivo_contatos as $key => $motivo_contato)
            <option value="{{$motivo_contato->id}}" {{ old('motivo_contato') == $motivo_contato->id ? 'selected' : '' }}>{{$motivo_contato->motivo_contato}}</option>    
        @endforeach
    </select>
    <br>
    <textarea name="mensagem" value="{{ old('mensagem')}}" class="{{ $classe }}" placeholder="Preencha aqui a sua mensagem"></textarea>
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>
