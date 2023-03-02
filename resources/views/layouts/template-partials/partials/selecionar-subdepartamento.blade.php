<div class="form-group focused">
    <label class="form-control-label" for="subdepartamento">Selecione o subdepartamento</label>
    <select name="subdepartamento_id" id="subdepartamento" class="form-control-select">
        <option disabled selected value="0">Selecione o subdepartamento</option>
        @foreach ($listaSdp as $sdp)
        <option value="{{ $sdp->departamento_id }}" class="dp" hidden></option>
        <option value="{{ $sdp->id }}" class="option">{{ $sdp->nome }}</option>
        @endforeach
    </select>
</div>

<script>
    var departamento_solicitacao = document.getElementById("departamento_solicitacao");
    var departamento_sub = document.getElementsByClassName('option');
    var sub = document.getElementsByClassName('dp');

    for(var k = 0; k < departamento_sub.length; k++) {
                departamento_sub[k].hidden = true;
            }

    function subDepartamento() {
            for(var j = 0; j < departamento_sub.length; j++) {
                if (departamento_solicitacao.value == sub[j].value) {
                departamento_sub[j].hidden = false;
            } else {
                departamento_sub[j].hidden = true;
            }
        } 
    }
</script>