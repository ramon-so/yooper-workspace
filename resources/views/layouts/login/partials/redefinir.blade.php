<form class="user" method="post">
    @csrf
    <div class="form-group">
        <input type="hidden" name="id" value="{{$_GET['usuario']}}">
        <input type="password" class="form-control form-control-user" id="senha" name="senha" required
            placeholder="Informa e nova senha">
    </div>
    <button class="btn btn-primary btn-user btn-block">
        Confirmar
    </button>
</form>
