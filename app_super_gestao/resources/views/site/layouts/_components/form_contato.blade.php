{{ $slot}}
<form action={{route('site.contato')}} method="post">
    @csrf
    <input name="Nome" type="text" placeholder="Nome" class={{$classe}}>
    <br>
    <input name="Telefone" type="text" placeholder="Telefone" class={{$classe}}>
    <br>
    <input name="E-mail" type="text" placeholder="E-mail" class={{$classe}}>
    <br>
    <select name="motivo_contato" class={{$classe}}>
        <option value="">Qual o motivo do contato?</option>
        <option value="1">Dúvida</option>
        <option value="2">Elogio</option>
        <option value="3">Reclamação</option>
    </select>
    <br>
    <textarea name="Mensagem" class={{$classe}}>Preencha aqui a sua mensagem</textarea>
    <br>
    <button type="submit" class={{$classe}}>ENVIAR</button>
</form>