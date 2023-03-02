<!-- Modal -->
<div class="modal" tabindex="-1" id="modal-adicionar-briefing">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Atualizar briefing</h5>
          <button type="button" class="close" data-dismiss="modal" onclick="fechar_modal_briefing()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('atualizar_briefing')}}" method="POST" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="id" value="" id="contrato_id_briefing">
            <div class="form-group">
              <label for="fileInput">Selecione o arquivo de briefing:</label>
              <input type="file" name="briefing" accept="PDF" required class="form-control" id="fileInput">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>