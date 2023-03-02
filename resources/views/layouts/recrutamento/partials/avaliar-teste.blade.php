<style>
    .pointer:hover{
        cursor: pointer;
    }
</style>
@foreach ($processosSeletivo as $processoSeletivo)
    @foreach ($candidatos as $candidato)
        <div class="col-12 row">
            {{-- {{dd($respostas[$a]['head'])}} --}}
            @if($respostas[$a]['head'] != null)
            <p>Avaliação Head: 
                <?php
                switch ($respostas[$a]['head']) {
                    case 'Supera':
                        echo "<i style=\"color: green;\" class=\"fa-solid fa-face-grin-beam\"></i>";
                        break;
                        case 'Atende':
                        echo "<i style=\"color: yellow;\" class=\"fa-solid fa-face-smile\"></i>";
                        break;
                        case 'Parcialmente':
                        echo "<i style=\"color: oragen;\" class=\"fa-solid fa-face-meh\"></i>";
                        break;
                        case 'Não Atende':
                        echo "<i style=\"color: red;\" class=\"fa-solid fa-face-frown\"></i>";
                        break;
                    
                    default:
                        # code...
                        break;
                }
                ?>
            </p>
            <p>Parecer Head: {{$respostas[$a]['head_parecer']}}</p>
            @endif
            @if($respostas[$a]['gyg'] != null)
            <p>Avaliação Gente y Gestão: 
                <?php
                switch ($respostas[$a]['gyg']) {
                    case 'Supera':
                        echo "<i style=\"color: green;\" class=\"fa-solid fa-face-grin-beam\"></i>";
                        break;
                        case 'Atende':
                        echo "<i style=\"color: yellow;\" class=\"fa-solid fa-face-smile\"></i>";
                        break;
                        case 'Parcialmente':
                        echo "<i style=\"color: oragen;\" class=\"fa-solid fa-face-meh\"></i>";
                        break;
                        case 'Não Atende':
                        echo "<i style=\"color: red;\" class=\"fa-solid fa-face-frown\"></i>";
                        break;
                    
                    default:
                        # code...
                        break;
                }
                ?>
            </p>
            <p>Parecer Gente y Gestão: {{$respostas[$a]['gyg_parecer']}}</p>
            @endif
            @if ((Auth::user()->acesso == 'Head' || Auth::user()->acesso == 'Master') && $respostas[$a]['head'] == null)
                <form class="col-12 col-lg-6 justify-content-center align-items-center" method="post"
                    action="/processo-seletivo/{{ $processoSeletivo->processo_id }}/candidato/{{ $candidato->candidato_id }}/avaliar-head/{{ $respostas[$a]->resposta_id }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row row-avaliar">
                        <div class="col-12">
                            <div class="card bg-white pt-4 pb-4 pl-4 pr-4 mb-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="select-avaliar-head">Avaliar Teste
                                        (Head)
                                    </label>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" name="avaliador" value="head"> 
                                            <input type="number" name="user_id" required class="form-control" hidden
                                                value="{{ Auth::user()->id }}">
                                            @foreach ($processosSeletivo as $processo)
                                                <input type="number" name="processo_id" required class="form-control"
                                                    hidden value="{{ $processo->processo_id }}">
                                            @endforeach
                                            @foreach ($candidatos as $candidato)
                                                <input type="number" name="candidato_id" required class="form-control"
                                                    hidden value="{{ $candidato->candidato_id }}">
                                            @endforeach
                                            <input type="radio" class="nao-atende"
                                                id="nao-atende-{{ $respostas[$a]->resposta_id }}" name="avaliacao[]"
                                                value="Não Atende" style="display:none;">
                                            <label for="nao-atende-{{ $respostas[$a]->resposta_id }}"
                                                class="label-nao-atende pointer" data-toogle="tooltip" data-placement="top"
                                                title="Não atende"><i onclick="setChecked(this, 'red')" class="fa-solid check fa-face-frown"></i></label>
                                            <input type="radio" class="parcialmente"
                                                id="parcialmente-{{ $respostas[$a]->resposta_id }}" name="avaliacao[]"
                                                value="Parcialmente" style="display:none;">
                                            <label for="parcialmente-{{ $respostas[$a]->resposta_id }}"
                                                class="label-parcialmente pointer" data-toogle="tooltip" data-placement="top"
                                                title="Parcialmente"><i onclick="setChecked(this, 'orange')" class="fa-solid check fa-face-meh"></i></label>
                                            <input type="radio" class="atende"
                                                id="atende-{{ $respostas[$a]->resposta_id }}" name="avaliacao[]"
                                                style="display:none;" value="Atende">
                                            <label for="atende-{{ $respostas[$a]->resposta_id }}" class="label-atende pointer"
                                                data-toogle="tooltip" data-placement="top" title="Atende"><i
                                                    class="fa-solid check fa-face-smile" onclick="setChecked(this, 'yellow')"></i></label>
                                            <input type="radio" class="supera"
                                                id="supera-{{ $respostas[$a]->resposta_id }}" name="avaliacao[]"
                                                style="display:none;" value="Supera">
                                            <label for="supera-{{ $respostas[$a]->resposta_id }}" class="label-supera pointer"
                                                data-toogle="tooltip" data-placement="top" title="Supera"><i
                                                    class="fa-solid check fa-face-grin-beam" onclick="setChecked(this, 'green')"></i></label>
                                        </div>
                                    </div>
                                    <textarea class="form-control-text" name="observacao_head" required id="texto-avaliar-head" placeholder="Parecer:"></textarea>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            @if ((Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Master-RH' ||  Auth::user()->acesso == 'RH') && $respostas[$a]['gyg'] == null)
                <form class="col-12 col-lg-6 justify-content-center align-items-center" method="post"
                    action="/processo-seletivo/{{ $processoSeletivo->processo_id }}/candidato/{{ $candidato->candidato_id }}/avaliar-gyg/{{ $respostas[$a]->resposta_id }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row row-avaliar">
                        <div class="col-12">
                            <div class="card bg-white pt-4 pb-4 pl-4 pr-4 mb-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="select-avaliar-head">Avaliar Teste
                                        (Gente Y Gestão)</label>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" name="avaliador" value="gyg"> 
                                            <input type="number" name="user_id" required class="form-control" hidden
                                                value="{{ Auth::user()->id }}">
                                            @foreach ($processosSeletivo as $processo)
                                                <input type="number" name="processo_id" required class="form-control"
                                                    hidden value="{{ $processo->processo_id }}">
                                            @endforeach
                                            @foreach ($candidatos as $candidato)
                                                <input type="number" name="candidato_id" required
                                                    class="form-control" hidden
                                                    value="{{ $candidato->candidato_id }}">
                                            @endforeach
                                            <input type="radio" class="nao-atende-gyg"
                                                id="nao-atende-gyg-{{ $respostas[$a]->resposta_id }}"
                                                name="avaliacao[]" value="Não Atende" style="display:none;">
                                            <label for="nao-atende-gyg-{{ $respostas[$a]->resposta_id }}"
                                                class="label-nao-atende-gyg pointer" data-toogle="tooltip"
                                                data-placement="top" title="Não atende"><i
                                                    class="fa-solid check fa-face-frown" onclick="setChecked(this, 'red')"></i></label>
                                            <input type="radio" class="parcialmente-gyg"
                                                id="parcialmente-gyg-{{ $respostas[$a]->resposta_id }}"
                                                name="avaliacao[]" value="Parcialmente" style="display:none;">
                                            <label for="parcialmente-gyg-{{ $respostas[$a]->resposta_id }}"
                                                class="label-parcialmente-gyg pointer" data-toogle="tooltip"
                                                data-placement="top" title="Parcialmente"><i
                                                    class="fa-solid check fa-face-meh" onclick="setChecked(this, 'orange')"></i></label>
                                            <input type="radio" class="atende-gyg"
                                                id="atende-gyg-{{ $respostas[$a]->resposta_id }}" name="avaliacao[]"
                                                style="display:none;" value="Atende">
                                            <label for="atende-gyg-{{ $respostas[$a]->resposta_id }}"
                                                class="label-atende-gyg pointer" data-toogle="tooltip" data-placement="top"
                                                title="Atende"><i class="fa-solid check fa-face-smile" onclick="setChecked(this, 'yellow')"></i></label>
                                            <input type="radio" class="supera-gyg"
                                                id="supera-gyg-{{ $respostas[$a]->resposta_id }}" name="avaliacao[]"
                                                style="display:none;" value="Supera">
                                            <label for="supera-gyg-{{ $respostas[$a]->resposta_id }}"
                                                class="label-supera-gyg pointer" data-toogle="tooltip" data-placement="top"
                                                title="Supera"><i onclick="setChecked(this, 'green')" class="fa-solid check fa-face-grin-beam"></i></label>
                                        </div>
                                    </div>
                                    <textarea class="form-control-text" name="observacao_gyg" required id="texto-avaliar-gyg" placeholder="Parecer:"></textarea>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    @endforeach
@endforeach

<script>
    function setChecked(element, color){
        var elements = document.getElementsByClassName('check');
        for(var i = 0; i < elements.length; i++){
            elements[i].style.color = "";
        }
        element.style.color = color;
    }
</script>
