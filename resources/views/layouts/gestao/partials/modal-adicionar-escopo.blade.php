<!-- Modal -->
<div class="modal" tabindex="-1" id="modal-adicionar-escopo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Atualizar escopo</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="fechar_modal_escopo()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('atualizar_escopo')}}" method="POST" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="id" value="" id="escopo_id_briefing">
            <div class="form-group">
              <label for="fileInput">Selecione o arquivo de escopo:</label>
              <input type="file" name="escopo" accept="PDF" required class="form-control" id="fileInput">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>