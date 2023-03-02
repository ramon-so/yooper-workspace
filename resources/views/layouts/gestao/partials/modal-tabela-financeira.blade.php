<!-- Modal -->
<div class="modal" tabindex="-1" id="modal-tabela-financeira">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tabela financeira</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('atualizar_tabela')}}" method="POST" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="id" value="{{$cliente->id}}" id="cliente_id_tabela_financeira">
            <div class="form-group">
              <label for="fileInput">Selecione a imagem da tabela financeira:</label>
              <input type="file" name="tabela_financeira" required class="form-control" id="fileInput">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>