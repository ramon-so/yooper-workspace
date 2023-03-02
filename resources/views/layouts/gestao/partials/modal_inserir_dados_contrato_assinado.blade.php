<!-- Modal de Inserção de Dados -->
<div class="modal fade" id="modal-inserir-dados" tabindex="-1" role="dialog" aria-labelledby="modal-inserir-dados-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-inserir-dados-label">Inserir Dados do Contrato</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-inserir-dados" action="{{ route('contrato_assinados.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="form-group">
              <label for="cliente_id" class="col-form-label">ID do Cliente:</label>
              <input type="text" class="form-control" id="cliente_id" name="cliente_id" readonly>
            </div>
            <div class="form-group">
              <label for="data_assinatura" class="col-form-label">Data da Assinatura:</label>
              <input type="date" class="form-control" id="data_assinatura" name="data_assinatura" required>
            </div>
            <div class="form-group">
              <label for="observacao" class="col-form-label">Observação:</label>
              <textarea class="form-control" id="observacao" name="observacao"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Inserir Dados</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    // Passa o ID do cliente selecionado para o campo correspondente do formulário de inserção de dados
    $('#modal-inserir-dados').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Botão que acionou o modal
      var clienteId = button.data('cliente-id'); // Extrai o valor do atributo "data-cliente-id" do botão
      var modal = $(this);
      modal.find('#cliente_id').val(clienteId); // Insere o valor do ID do cliente no campo correspondente do formulário
    })
  </script>