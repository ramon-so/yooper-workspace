@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Cadastro de Avaliação')
@section('pagina', 'Cadastrar Avaliação')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">
       @include('layouts.template-partials.alerts')
        <div class="row mb-5 mt-5">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastrar avaliação</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                         @include('layouts.recrutamento.partials.cadastrar-avaliacao')
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header border-0 justify-content-lg-start">
                        <h3 class="mb-0 text-center text-lg-left">Avaliações cadastradas</h3>
                    </div>
                    <div class="table-responsive table-solicitacoes">
                         @include('layouts.recrutamento.partials.avaliacoes-cadastradas') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#quantidade-dissertativa').keyup(() => {
        var quantidade_dissertativa = $('#quantidade-dissertativa').val();
        var element_dissertativa = document.getElementById('lista-dissertativas');
        var br = document.createElement("br");

        for (let i = 0; i < quantidade_dissertativa; i++) {
            var x = document.createElement("textarea");
            x.setAttribute("class", "dissetativa form-control mt-2");
            x.setAttribute("value", "");
            x.setAttribute("id", "dissetativa-" + i);
            x.setAttribute("name", "dissertativa[]");
            x.setAttribute("placeholder", "Questão dissertativa " + (i + 1));
            x.setAttribute("required", "");
            document.getElementById("lista-dissertativas").appendChild(x);
            var y = document.createElement("input");
            y.setAttribute("class", "dissetativa form-control mt-2");
            y.setAttribute("type", "file")
            y.setAttribute("id", "dissetativaFile-" + i);
            y.setAttribute("name", "dissertativaFile[]");
            y.setAttribute("title", "Imagem opcional");
            document.getElementById("lista-dissertativas").appendChild(y);
        }
        document.getElementById("lista-dissertativas").appendChild(br);
         if((quantidade_dissertativa == 0) || (quantidade_dissertativa > 5)) {
             element_dissertativa.innerHTML = '';
        }
    }
    );

   $('#quantidade-alternativa').keyup(() => {
        var quantidade_alternativa = $('#quantidade-alternativa').val();
        var element_alternativa = document.getElementById('lista-alternativas');
        
        for (let i = 0; i < quantidade_alternativa; i++) {
            var x = document.createElement("INPUT");
            var tx = document.createElement("textarea");
            var br = document.createElement("br");
            
            tx.setAttribute("class", "alternativa form-control mt-2");
            tx.setAttribute("value", "");
            tx.setAttribute("id", "alternativa-" + i);
            tx.setAttribute("name", "questao_alternativa[]");
            tx.setAttribute("placeholder", "Questão Alternativa " + (i + 1));
            tx.setAttribute("required", "");
            document.getElementById("lista-alternativas").appendChild(tx)

            var y = document.createElement("input");
            y.setAttribute("class", "alternativa form-control mt-2");
            y.setAttribute("type", "file")
            y.setAttribute("id", "alternativaFile-" + i);
            y.setAttribute("name", "alternativaFile[]");
            y.setAttribute("title", "Imagem opcional");
            document.getElementById("lista-alternativas").appendChild(y);

            var b = document.createElement("select");

            for (let j = 0; j < 4; j++) {  
            var chr = String.fromCharCode(65 + j);
            var a = document.createElement("INPUT");
            a.setAttribute("type", "text");
            a.setAttribute("class", "alternativa-resposta form-control mt-2");
            a.setAttribute("value", "");
            a.setAttribute("id", "alternativa-" + i);
            a.setAttribute("name", "alternativa["+i+"][]");
            a.setAttribute("placeholder", "Alternativa " + chr + " Questão " + (i + 1));
            a.setAttribute("required", "");
            document.getElementById("lista-alternativas").appendChild(a)
            }
            b.setAttribute("class", "alternativa-correta form-control mt-2");
            b.setAttribute("id", "alternativa_correta_" + i);
            b.setAttribute("name", "alternativa_correta["+i+"][]");
            b.setAttribute("required", "");
            document.getElementById("lista-alternativas").appendChild(b)
            
            for (let k = 0; k < 4; k++) {  
            var c = document.createElement("option");
            var chr2 = String.fromCharCode(65 + k);
            c.setAttribute("value", "" + chr2 + "");
            c.setAttribute("class", "alternativa_correta_option_"+ i + k);
            document.getElementById("alternativa_correta_" + i + "").appendChild(c);
            document.querySelector(".alternativa_correta_option_" + i + k + "").innerHTML = "Alternativa correta: "+chr2+"";
            }
            document.getElementById("lista-alternativas").appendChild(br);

            
        }
        if((quantidade_alternativa == 0)) {
             element_alternativa.innerHTML = '';
        }
    }
   );

        document.getElementById('btn-limpar-dissertativas').addEventListener('click', function() {
         var element_dissertativa = document.getElementById('lista-dissertativas');
        element_dissertativa.innerHTML = '';
       });
        document.getElementById('btn-limpar-alternativas').addEventListener('click', function() {
         var element_alternativa = document.getElementById('lista-alternativas');
        element_alternativa.innerHTML = '';
       });
</script>

@endsection
