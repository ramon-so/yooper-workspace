(function ($) {
    var type = null;

    $.fn.cpfcnpj = function (options) {
        // Default settings
        var settings = $.extend({
            mask: false,
            validate: 'cpfcnpj',
            event: 'focusout',
            handler: $(this),
            ifValid: null,
            ifInvalid: null
        }, options);

        if (settings.mask) {
            if (jQuery().mask == null) {
                settings.mask = false;
                console.log("jQuery mask not found.");
            } else {
                if (settings.validate == 'cpf') {
                    $(this).mask('000.000.000-00');
                } else if (settings.validate == 'cnpj') {
                    $(this).mask('00.000.000/0000-00');
                } else {
                    var ctrl = $(this);
                    var opt = {
                        onKeyPress: function (field) {
                            var masks = ['000.000.000-00', '00.000.000/0000-00'];
                            msk = (field.length > 14) ? masks[1] : masks[0];
                            ctrl.mask(msk, this);
                        }
                    };

                    $(this).mask('000.000.000-00', opt);
                }
            }

        }

        return this.each(function () {
            var valid = null;
            var control = $(this);

            $(document).on(settings.event, settings.handler,
                function () {
                    if (control.val().length == 14 || control.val().length == 18) {
                        if (settings.validate == 'cpf') {
                            valid = validate_cpf(control.val());
                        } else if (settings.validate == 'cnpj') {
                            valid = validate_cnpj(control.val())
                        } else if (settings.validate == 'cpfcnpj') {
                            if (validate_cpf(control.val())) {
                                valid = true;
                                type = 'cpf';
                            } else if (validate_cnpj(control.val())) {
                                valid = true;
                                type = 'cnpj';
                            } else valid = false;
                        }
                    } else valid = false;

                    if ($.isFunction(settings.ifValid)) {
                        if (valid != null && valid) {
                            if ($.isFunction(settings.ifValid)) {
                                var callbacks = $.Callbacks();
                                callbacks.add(settings.ifValid);
                                callbacks.fire(control);
                            }
                        } else if ($.isFunction(settings.ifInvalid)) {
                            settings.ifInvalid(control);
                        }
                    }
                });
        });
    }

    function validate_cnpj(val) {
        if (val.match(/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/) != null) {
            var val1 = val.substring(0, 2);
            var val2 = val.substring(3, 6);
            var val3 = val.substring(7, 10);
            var val4 = val.substring(11, 15);
            var val5 = val.substring(16, 18);



            var i;
            var number;
            var result = true;

            number = (val1 + val2 + val3 + val4 + val5);

            s = number;

            c = s.substr(0, 12);
            var dv = s.substr(12, 2);
            var d1 = 0;

            for (i = 0; i < 12; i++)
                d1 += c.charAt(11 - i) * (2 + (i % 8));

            if (d1 == 0)
                result = false;

            d1 = 11 - (d1 % 11);

            if (d1 > 9) d1 = 0;

            if (dv.charAt(0) != d1)
                result = false;

            d1 *= 2;
            for (i = 0; i < 12; i++) {
                d1 += c.charAt(11 - i) * (2 + ((i + 1) % 8));
            }

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(1) != d1)
                result = false;

            return result;
        }
        return false;
    }

    function validate_cpf(val) {
        if (val == '000.000.000-00' || val == '111.111.111-11' || val == '222.222.222-22' || val == '333.333.333-33' || val == '444.444.444-44' ||
            val == '555.555.555-55' || val == '666.666.666-66' || val == '777.777.777-77' || val == '888.888.888-88' || val == '999.999.999-99') {
            return false
        } else {
            if (val.match(/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/) != null) {
                var val1 = val.substring(0, 3);
                var val2 = val.substring(4, 7);
                var val3 = val.substring(8, 11);
                var val4 = val.substring(12, 14);

                var i;
                var number;
                var result = true;

                number = (val1 + val2 + val3 + val4);

                s = number;
                c = s.substr(0, 9);
                var dv = s.substr(9, 2);
                var d1 = 0;

                for (i = 0; i < 9; i++) {
                    d1 += c.charAt(i) * (10 - i);
                }

                if (d1 == 0)
                    result = false;

                d1 = 11 - (d1 % 11);
                if (d1 > 9) d1 = 0;

                if (dv.charAt(0) != d1)
                    result = false;

                d1 *= 2;
                for (i = 0; i < 9; i++) {
                    d1 += c.charAt(i) * (11 - i);
                }

                d1 = 11 - (d1 % 11);
                if (d1 > 9) d1 = 0;

                if (dv.charAt(1) != d1)
                    result = false;

                return result;
            }

            return false;
        }
    }
}(jQuery));



$(document).ready(function () {
    $('#cpf').cpfcnpj({
        mask: true,
        validate: 'cpfcnpj',
        ifValid: function (input) {
            $('#cpf').removeClass('erro');
            $('#cpf').addClass('ok');
            $('.icon-erro').css('display', 'none');
            $('.icon-ok').css('display', 'flex');
            $('.cadastrar-func').css('display', 'block');
        },
        ifInvalid: function (input) {
            $('#cpf').removeClass('ok');
            $('#cpf').addClass('erro');
            $('.icon-ok').css('display', 'none');
            $('.icon-erro').css('display', 'flex');
            $('.cadastrar-func').css('display', 'none');

        }
    });

    var status_processo_seletivo = document.querySelectorAll('.nome-sps');
    $('#searchStatusProcesso').keyup(() => {
    var valueDigitado = $('#searchStatusProcesso').val();

    for (var i = 0; i < status_processo_seletivo.length; i++) {
        if (status_processo_seletivo[i].innerHTML.toLowerCase().indexOf(valueDigitado.toLowerCase()) > -1) {
            status_processo_seletivo[i].parentNode.style.display = 'table-row';
        } else {
            status_processo_seletivo[i].parentNode.style.display = 'none';
        }
    }
    });

    var status_candidato = document.querySelectorAll('.nome-sc');
    $('#searchStatusCandidatos').keyup(() => {
    var valueDigitadoSc = $('#searchStatusCandidatos').val();

    for (var z = 0; z < status_candidato.length; z++) {
        if (status_candidato[z].innerHTML.toLowerCase().indexOf(valueDigitadoSc.toLowerCase()) > -1) {
            status_candidato[z].parentNode.style.display = 'table-row';
        } else {
            status_candidato[z].parentNode.style.display = 'none';
        }
    }
    });

    var servico = document.querySelectorAll('.nome-sv');
    $('#searchServico').keyup(() => {
    var valueDigitadoSc = $('#searchServico').val();

    for (var a = 0; a < servico.length; a++) {
        if (servico[a].innerHTML.toLowerCase().indexOf(valueDigitadoSc.toLowerCase()) > -1) {
            servico[a].parentNode.style.display = 'table-row';
        } else {
            servico[a].parentNode.style.display = 'none';
        }
    }
    });

    var head = document.querySelectorAll('.nome-head');
    $('#searchHeads').keyup(() => {
    var valueDigitadoSc = $('#searchHeads').val();

    for (var b = 0; b < head.length; b++) {
        if (head[b].innerHTML.toLowerCase().indexOf(valueDigitadoSc.toLowerCase()) > -1) {
            head[b].parentNode.style.display = 'table-row';
        } else {
            head[b].parentNode.style.display = 'none';
        }
    }
    });

    var subdepartamento = document.querySelectorAll('.nome-sd');
    $('#searchSubDepartamento').keyup(() => {
    var valueDigitadoSd = $('#searchSubDepartamento').val();

    for (var b = 0; b < subdepartamento.length; b++) {
        if (subdepartamento[b].innerHTML.toLowerCase().indexOf(valueDigitadoSd.toLowerCase()) > -1) {
            subdepartamento[b].parentNode.style.display = 'table-row';
        } else {
            subdepartamento[b].parentNode.style.display = 'none';
        }
    }
    });

    var processo = document.querySelectorAll('.nome-departamento');
    $('#searchProcesso').keyup(() => {
    var valueDigitadoPs = $('#searchProcesso').val();
       
        
    for (var c = 0; c < processo.length; c++) {
        if (processo[c].innerHTML.toLowerCase().indexOf(valueDigitadoPs.toLowerCase()) > -1) {
            processo[c].parentNode.parentNode.parentNode.style.display = 'flex';
        } else { (!processo[c].innerHTML.toLowerCase().indexOf(valueDigitadoPs.toLowerCase()) > -1) 
            processo[c].parentNode.parentNode.parentNode.style.display = 'none';
        } 
    }
    });

    var candidato = document.querySelectorAll('.nome-candidato');
    $('#searchCandidato').keyup(() => {
    var valueDigitadoPs = $('#searchCandidato').val();
       
        
    for (var c = 0; c < candidato.length; c++) {
        if (candidato[c].innerHTML.toLowerCase().indexOf(valueDigitadoPs.toLowerCase()) > -1) {
            candidato[c].parentNode.parentNode.parentNode.parentNode.style.display = 'flex';
        } else { (!candidato[c].innerHTML.toLowerCase().indexOf(valueDigitadoPs.toLowerCase()) > -1) 
            candidato[c].parentNode.parentNode.parentNode.parentNode.style.display = 'none';
        } 
    }
    });

});

//VALIDAÇÃO CPF




// Departamentos

$(document).ready(function () {
    var funcionario = document.querySelectorAll('.nome-usuario');
    $('#searchName').keyup(() => {
        var digitado = $('#searchName').val();

        for (var i = 0; i < funcionario.length; i++) {
            if (funcionario[i].innerHTML.toLowerCase().indexOf(digitado.toLowerCase()) > -1) {
                funcionario[i].parentNode.parentNode.parentNode.style.display = 'block';
            } else {
                funcionario[i].parentNode.parentNode.parentNode.style.display = 'none';
            }
        }
    });

    var depto = document.querySelectorAll('.nome-depto');
    $('#searchDepto').keyup(() => {
        var valueDigitado = $('#searchDepto').val();

        for (var i = 0; i < depto.length; i++) {
            if (depto[i].innerHTML.toLowerCase().indexOf(valueDigitado.toLowerCase()) > -1) {
                depto[i].parentNode.style.display = 'table-row';
            } else {
                depto[i].parentNode.style.display = 'none';
            }
        }
    });

    var captacao = document.querySelectorAll('.nome-captacao');
    $('#searchCaptacao').keyup(() => {
        var valueDigitado = $('#searchCaptacao').val();

        for (var x = 0; x < captacao.length; x++) {
            if (captacao[x].innerHTML.toLowerCase().indexOf(valueDigitado.toLowerCase()) > -1) {
                captacao[x].parentNode.style.display = 'table-row';
            } else {
                captacao[x].parentNode.style.display = 'none';
            }
        }
    });

    var sps = document.querySelectorAll('.nome-sps');
    $('#searchStatusProcesso').keyup(() => {
        var valueDigitadoSps = $('#searchStatusProcesso').val();

        for (var i = 0; i < sps.length; i++) {
            if (sps[i].innerHTML.toLowerCase().indexOf(valueDigitadoSps.toLowerCase()) > -1) {
                sps[i].parentNode.style.display = 'table-row';
            } else {
                sps[i].parentNode.style.display = 'none';
            }
        }
    });
});

function toggleInputDp(dp_id) {

    const nomeDp = document.getElementById(`departamento-name-${dp_id}`);
    const inputs_cadastro = document.getElementById(`cadastro_dp`);
    const inputs_edit = document.getElementById(`alteracao_dp`);

    inputs_edit.removeAttribute('hidden');
    inputs_cadastro.hidden = true;

    document.getElementById(`input_departamento_editar`).value = nomeDp.textContent;
    document.getElementById(`input_dp_id`).value = dp_id;

}

function toggleInputDpClosed() {
    const inputs_cadastro = document.getElementById(`cadastro_dp`);
    const inputs_edit = document.getElementById(`alteracao_dp`);

    inputs_cadastro.removeAttribute('hidden');
    inputs_edit.hidden = true;
}

function editar_dp() {

    const dp_id = document.getElementById(`input_dp_id`).value;
    const nome = document.getElementById(`input_departamento_editar`).value;

    let Data = new FormData();
    const token = document
        .querySelector(`input[name="_token"]`)
        .value;
    Data.append('departamento', nome);
    Data.append('_token', token);

    const url = `/departamento/${dp_id}/editar`;
    fetch(url, {
        method: 'POST',
        body: Data
    }).then(() => {
        toggleInputDp(dp_id);
        document.getElementById(`departamento-name-${dp_id}`).textContent = nome;
    });
    location.reload(true);
}

function ativar_inativar_dp(dp_id, status) {
    if (status == "ativar") {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Sim');
        Data.append('_token', token);

        const url = `/departamento/${dp_id}/ativar_inativar`;

        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Departamento ativado, clique em ok, para atualizar a página.");
            window.location.href = "/departamento";
        });

    } else {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Não');
        Data.append('_token', token);

        const url = `/departamento/${dp_id}/ativar_inativar`;

        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Departamento inativado, clique em ok, para atualizar a página.");
            window.location.href = "/departamento";
        });
    }

}

function ativar_inativar_usuario_funcionario(userid, funcid, status) {
    if (status == "ativar") {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Sim');
        Data.append('_token', token);

        const url = `/usuario/${userid}/ativar_inativar`;

        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Funcionario/Usuário ativado, clique em ok, para atualizar a página.");
            window.location.href = "/usuarios";
        });
    } else {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Não');
        Data.append('_token', token);

        const url = `/usuario/${userid}/ativar_inativar`;

        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Funcionario/Usuário inativado, clique em ok, para atualizar a página.");
            window.location.href = "/usuarios";
        });
    }

}

function ativar_inativar_curso(cursoId, status) {
    if (status == "ativar") {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Sim');
        Data.append('_token', token);

        const url = `/curso/${cursoId}/ativar_inativar`;

        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Curso ativado, clique em ok, para atualizar a página.");
            window.location.href = "/cursos";
        });
    } else {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Não');
        Data.append('_token', token);

        const url = `/curso/${cursoId}/ativar_inativar`;

        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Curso inativado, clique em ok, para atualizar a página.");
            window.location.href = "/cursos";
        });
    }

}

    function mostrarSenha(id) {
        var x = document.getElementById(`password-${id}`);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function editarUsuario(id){
        $(`.display-edit-${id}`).css('display', 'none');
        $(`.input-edit-${id}`).css('display', 'block');
        document.getElementById(`password-${id}`).disabled = false;
        document.getElementById(`password-${id}`).type = "text";
        $('.ativo').css('display', 'none');
        $(`.ativo-${id}`).css('display', 'block');
        $(`.ativo-${id}`).addClass('edit-user');

        $(`.ativo-${id}`).addClass('edit-user');

        $(`.btn-inativar-${id}`).css('display', 'none');
        $(`.btn-editar-${id}`).css('display', 'none');
        $(`.btn-salvar-edicao-${id}`).css('display', 'block');
        $(`.btn-group-edit`).css('display', 'inline-flex');
}
    function editarCurso(id) {
        $(`.informacao-curso`).css('display', 'none');
        $(`.edit-informacao-curso`).css('display', 'block');
        
    }

    function salvarUsuario(id, func_id){
        const nome = document.getElementsByClassName(`input-edit-nome-func-${id}`)[0].value;
        const departamento = document.getElementsByClassName(`input-edit-dept-${id}`)[0].value;
        const user_name = document.getElementsByClassName(`input-edit-nome-user-${id}`)[0].value;
        const senha = document.getElementsByClassName(`input-edit-senha-${id}`)[0].value;
        const email = document.getElementsByClassName(`input-edit-email-${id}`)[0].value;

        console.log(nome);
        console.log(departamento);
        console.log(user_name);
        console.log(senha);
        console.log(email);
        
        if(validarEmail(email) == false){
            alert("E-mail Inválido, por favor informe um e-mail válido");
        }else{
            if(nome && departamento && user_name && senha && email){
                let Data = new FormData();
                const token = document.querySelector(`input[name="_token"]`).value
                Data.append('nome', nome);
                Data.append('departamento', departamento);
                Data.append('user_name', user_name);
                Data.append('senha', senha);
                Data.append('email', email);
                Data.append('_token', token);
                
                const url = `/usuario/${id}/${func_id}/editar`
                fetch(url, {
                    method: 'POST',
                    body: Data
                }).then(() => {
                    alert('Usuário alterado com sucesso.')
                    window.location.href = "/usuarios";
                });

                Data.append('_token', token);
            }else{
                alert('Por favor, preencha todos os campos.')
            }
        }
    }

    function validarEmail(email){
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {
            $("MsgErro").show()
            .text('Por favor, informe um email válido.');
            return false;
        }
    }

    function ordemCurso(){
        const cursoId = document.getElementById('curso').value;

        const url = new Request(`/curso/ordem/${cursoId}`);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                document.getElementById('inputOrdem').value = data.modulo_ordem;
            }) 
    }
// Inativos
function filtro_curso(filtro) {
    if (filtro == 'inativos') {
        $('.inativo').css('display', 'block');
        $('.ativo').css('display', 'none');
    } else if (filtro == 'todos') {
        $('.inativo').css('display', 'block');
        $('.ativo').css('display', 'block');
    } else {
        $('.inativo').css('display', 'none');
        $('.ativo').css('display', 'block');
    }
}

function filtro_usuario(filtro) {
    if (filtro == 'inativos') {
        $('.inativo').css('display', 'block');
        $('.ativo').css('display', 'none');
    } else if (filtro == 'todos') {
        $('.inativo').css('display', 'block');
        $('.ativo').css('display', 'block');
    } else {
        $('.inativo').css('display', 'none');
        $('.ativo').css('display', 'block');
    }
}

function filtro_dp(filtro) {
    if (filtro == 'inativos') {
        $('.inativo').css('display', 'table-row');
        $('.ativo').css('display', 'none');
    } else if (filtro == 'todos') {
        $('.inativo').css('display', 'table-row');
        $('.ativo').css('display', 'table-row');
    } else {
        $('.inativo').css('display', 'none');
        $('.ativo').css('display', 'table-row');
    }
}

function filtro_cp(filtro) {
    if (filtro == 'inativos') {
        $('.inativo').css('display', 'table-row');
        $('.ativo').css('display', 'none');
    } else if (filtro == 'todos') {
        $('.inativo').css('display', 'table-row');
        $('.ativo').css('display', 'table-row');
    } else {
        $('.inativo').css('display', 'none');
        $('.ativo').css('display', 'table-row');
    }
}

function filtro_curso_modulo(filtro) {
    if (filtro == 'inativos') {
        $('.inativo').css('display', 'block');
        $('.ativo').css('display', 'none');
    } else if (filtro == 'todos') {
        $('.inativo').css('display', 'block');
        $('.ativo').css('display', 'block');
    } else {
        $('.inativo').css('display', 'none');
        $('.ativo').css('display', 'block');
    }
}



function ativar_inativar_modulo(id, moduloid, status) {
    if (status == "ativar") {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Sim');
        Data.append('_token', token);

        const url = `/curso/${moduloid}/ativar_inativar_modulo`;

        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Módulo ativado, clique em ok, para atualizar a página.");
            window.location.href = `/curso/${id}`;
        });
    } else {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Não');
        Data.append('_token', token);

        const url = `/curso/${moduloid}/ativar_inativar_modulo`;

        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Módulo inativado, clique em ok, para atualizar a página.");
            window.location.href = `/curso/${id}`;
        });
    }

}

    function readURL(id) {
        console.log('entrou url');
        if (document.getElementById(`arquivo_${id}`).files) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(`#image-${id}`).attr('src', e.target.result);
                $(`#image-${id}`).css('display', 'block');
            }

            reader.readAsDataURL(document.getElementById(`arquivo_${id}`).files[0]);
        }
    }

    function readURLBanners(id) {
        if (document.getElementById(`banner_${id}`).files) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(`#image-banner-${id}`).attr('src', e.target.result);
                $(`#image-banner-${id}`).css('display', 'block');
            }
            reader.readAsDataURL(document.getElementById(`banner_${id}`).files[0]);
        }
    }


    function editarEmail() {
        $('#info-basico').css('display', 'block');
        $('#editarEmail').css('display', 'none');
        $('#fecharEdicao').css('display', 'block');
    }

    function fecharEdicao() {
        $('#info-basico').css('display', 'none');
        $('#editarEmail').css('display', 'block');
        $('#fecharEdicao').css('display', 'none');
}
    

//STATUS PROCESSO SELETIVO

function toggleInputSps(sps_id) {

const nomeSps = document.getElementById(`status-processo-seletivo-name-${sps_id}`);
const inputs_cadastro_sps = document.getElementById(`cadastro_sps`);
const inputs_edit_sps = document.getElementById(`alteracao_sps`);

inputs_edit_sps.removeAttribute('hidden');
inputs_cadastro_sps.hidden = true;

document.getElementById(`input_status_processo_seletivo_editar`).value = nomeSps.textContent;
document.getElementById(`input_sps_id`).value = sps_id;

}

function toggleInputSpsClosed() {
    const inputs_cadastro_sps = document.getElementById(`cadastro_sps`);
    const inputs_edit_sps = document.getElementById(`alteracao_sps`);
    
    inputs_cadastro_sps.removeAttribute('hidden');
    inputs_edit_sps.hidden = true; 
}

function editar_sps() {

const sps_id = document.getElementById(`input_sps_id`).value;
const nome = document.getElementById(`input_status_processo_seletivo_editar`).value;

let Data = new FormData();
const token = document
    .querySelector(`input[name="_token"]`)
    .value;
Data.append('nome', nome);
Data.append('_token', token);

const url = `/status-processo-seletivo/${sps_id}/editar`;
fetch(url, {
    method: 'POST',
    body: Data
}).then(() => {
    toggleInputSps(sps_id);
    document.getElementById(`status-processo-seletivo-name-${sps_id}`).textContent = nome;
});
location.reload(true);
}

function ativar_inativar_sps(sps_id, status) {
if (status == "ativar") {
    let Data = new FormData();
    const token = document
        .querySelector(`input[name="_token"]`)
        .value;
    Data.append('ativo', 'Sim');
    Data.append('_token', token);

    const url = `/status-processo-seletivo/${sps_id}/ativar_inativar`;

    fetch(url, {
        method: 'POST',
        body: Data
    }).then(() => {
        alert("Status ativado, clique em ok, para atualizar a página.");
        window.location.href = "/status-processo-seletivo";
    });

} else {
    let Data = new FormData();
    const token = document
        .querySelector(`input[name="_token"]`)
        .value;
    Data.append('ativo', 'Não');
    Data.append('_token', token);

    const url = `/status-processo-seletivo/${sps_id}/ativar_inativar`;

    fetch(url, {
        method: 'POST',
        body: Data
    }).then(() => {
        alert("Status inativado, clique em ok, para atualizar a página.");
        window.location.href = "/status-processo-seletivo";
    });
}

}


//STATUS CANDIDATOS

function toggleInputSc(sc_id) {

const nomesc = document.getElementById(`status-candidato-nome-${sc_id}`);
const inputs_cadastro_sc = document.getElementById(`cadastro_sc`);
const inputs_edit_sc = document.getElementById(`alteracao_sc`);

inputs_edit_sc.removeAttribute('hidden');
inputs_cadastro_sc.hidden = true;

document.getElementById(`input_status_candidato_editar`).value = nomesc.textContent;
document.getElementById(`input_sc_id`).value = sc_id;

}

function toggleInputScClosed() {

    const inputs_cadastro_sc = document.getElementById(`cadastro_sc`);
    const inputs_edit_sc = document.getElementById(`alteracao_sc`);
    
    inputs_cadastro_sc.removeAttribute('hidden');
    inputs_edit_sc.hidden = true;
}

function editar_sc() {

const sc_id = document.getElementById(`input_sc_id`).value;
const nome = document.getElementById(`input_status_candidato_editar`).value;

let Data = new FormData();
const token = document
    .querySelector(`input[name="_token"]`)
    .value;
Data.append('nome', nome);
Data.append('_token', token);

const url = `/status-candidatos/${sc_id}/editar`;
fetch(url, {
    method: 'POST',
    body: Data
}).then(() => {
    toggleInputSc(sc_id);
    document.getElementById(`status-candidato-nome-${sc_id}`).textContent = nome;
});
location.reload(true);
}

function ativar_inativar_sc(sc_id, status) {
if (status == "ativar") {
    let Data = new FormData();
    const token = document
        .querySelector(`input[name="_token"]`)
        .value;
    Data.append('ativo', 'Sim');
    Data.append('_token', token);

    const url = `/status-candidatos/${sc_id}/ativar_inativar`;

    fetch(url, {
        method: 'POST',
        body: Data
    }).then(() => {
        alert("Status ativado, clique em ok, para atualizar a página.");
        window.location.href = "/status-candidatos";
    });

} else {
    let Data = new FormData();
    const token = document
        .querySelector(`input[name="_token"]`)
        .value;
    Data.append('ativo', 'Não');
    Data.append('_token', token);

    const url = `/status-candidatos/${sc_id}/ativar_inativar`;

    fetch(url, {
        method: 'POST',
        body: Data
    }).then(() => {
        alert("Status inativado, clique em ok, para atualizar a página.");
        window.location.href = "/status-candidatos";
    });
}

}

//SERVICOS

function toggleInputSv(sv_id) {

    const nomesv = document.getElementById(`servico-nome-${sv_id}`);
    const inputs_cadastro_sv = document.getElementById(`cadastro_sv`);
    const inputs_edit_sv = document.getElementById(`alteracao_sv`);
    
    inputs_edit_sv.removeAttribute('hidden');
    inputs_cadastro_sv.hidden = true;
    
    document.getElementById(`input_servico_editar`).value = nomesv.textContent;
    document.getElementById(`input_sv_id`).value = sv_id;
}

function toggleInputSvClosed() {

    const inputs_cadastro_sv = document.getElementById(`cadastro_sv`);
    const inputs_edit_sv = document.getElementById(`alteracao_sv`);
    
    inputs_cadastro_sv.removeAttribute('hidden');
    inputs_edit_sv.hidden = true;
}
    
    function editar_sv() {
    
    const sv_id = document.getElementById(`input_sv_id`).value;
    const nome = document.getElementById(`input_servico_editar`).value;
    
    let Data = new FormData();
    const token = document
        .querySelector(`input[name="_token"]`)
        .value;
    Data.append('nome', nome);
    Data.append('_token', token);
    
    const url = `/servicos/${sv_id}/editar`;
    fetch(url, {
        method: 'POST',
        body: Data
    }).then(() => {
        toggleInputSv(sv_id);
        document.getElementById(`servico-nome-${sv_id}`).textContent = nome;
    });
    location.reload(true);
    }
    
    function ativar_inativar_sv(sv_id, status) {
    if (status == "ativar") {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Sim');
        Data.append('_token', token);
    
        const url = `/servicos/${sv_id}/ativar_inativar`;
    
        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Serviço ativado, clique em ok, para atualizar a página.");
            window.location.href = "/servicos";
        });
    
    } else {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Não');
        Data.append('_token', token);
    
        const url = `/servicos/${sv_id}/ativar_inativar`;
    
        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Serviço inativado, clique em ok, para atualizar a página.");
            window.location.href = "/servicos";
        });
    }
    
    }


    //HEAD

function toggleInputHd(hd_id, hd_dp_id, id) {

    const funcionariohd = document.getElementById(`head-nome-${id}`);
    const funcionariofoto = document.getElementById(`head-foto-${id}`);
    const funcionarioid = hd_id;
    const departamentoid = hd_dp_id;
    const departamentohd = document.getElementById(`departamento-nome-${id}`);
    const inputs_cadastro_hd = document.getElementById(`cadastro_hd`);
    const inputs_edit_hd = document.getElementById(`alteracao_hd`);

    inputs_edit_hd.removeAttribute('hidden');
    inputs_cadastro_hd.hidden = true;

        document.getElementById(`input_funcionario_editar`).textContent = funcionariohd.textContent;
        document.getElementById(`input_foto`).value = funcionariofoto.textContent;
        document.getElementById(`input_funcionario_editar`).value = funcionarioid;
        document.getElementById(`input_departamento_editar`).textContent = departamentohd.textContent;
        document.getElementById(`input_departamento_editar`).value = departamentoid;
        document.getElementById(`input_hd_id`).value = id;
    
    }

    function toggleInputHdClosed() {
        const inputs_cadastro_hd = document.getElementById(`cadastro_hd`);
        const inputs_edit_hd = document.getElementById(`alteracao_hd`);

        inputs_cadastro_hd.removeAttribute('hidden');
        inputs_edit_hd.hidden = true;

        }
    
      
    function editar_hd() {
    
        const hd_id = document.getElementById(`input_hd_id`).value;
        const funcionario = document.getElementById(`input_funcionario`).value;
        const funcionarioFoto = document.getElementById(`input_foto`).value;
        const departamento = document.getElementById(`input_departamento`).value;

        // var funcionarioNome = $('#input_funcionario').find(":selected").text();
        // var departamentoNome = $('#input_departamento').find(":selected").text();

        
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('funcionario_id', funcionario);
        Data.append('departamento_id', departamento);
        Data.append('_token', token);
        
        const url = `/heads/${hd_id}/editar`;
        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            // toggleInputHd(funcionarioNome, departamentoNome, hd_id);
            // document.getElementById(`head-nome-${hd_id}`).textContent = funcionarioNome;
            // document.getElementById(`head-foto-${hd_id}`).setAttribute('src', funcionarioFoto);
            // document.getElementById(`departamento-nome-${hd_id}`).textContent = departamentoNome;
        });
        location.reload(true);
        }

    
    function ativar_inativar_hd(hd_id, status) {
    if (status == "ativar") {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Sim');
        Data.append('_token', token);
    
        const url = `/heads/${hd_id}/ativar_inativar`;
    
        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Head ativado, clique em ok, para atualizar a página.");
            window.location.href = "/heads";
        });
    
    } else {
       
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Não');
        Data.append('_token', token);
    
        const url = `/heads/${hd_id}/ativar_inativar`;

        
        console.log(url);
    
        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Head inativado, clique em ok, para atualizar a página.");
            window.location.href = "/heads";
        });
    }
    
    }


    function inativarDash(id) {  
            let Data = new FormData();
            const token = document
            .querySelector(`input[name="_token"]`)
            .value;    

            Data.append('status', 'Inativo');
            Data.append('_token', token);

            const url = `/yoodash/${id}/inativar`;
    
        
            fetch(url, {
                method: 'POST',
                body: Data
            }).then(() => {
                // alert("Departamento inativado, clique em ok, para atualizar a página.");
                window.location.href = "/yoodash";
            });
        }

        
//SUB DEPARTAMENTOS

function toggleInputSd(sd_id, sd_dp_id) {

    const nomesd = document.getElementById(`subdepartamento-nome-${sd_id}`);
    const inputs_cadastro_sd = document.getElementById(`cadastro_sd`);
    const inputs_edit_sd = document.getElementById(`alteracao_sd`);
    const departamentoid = sd_dp_id;
    const departamentosd = document.getElementById(`departamento-nome-${sd_id}`);
    
    inputs_edit_sd.removeAttribute('hidden');
    inputs_cadastro_sd.hidden = true;
    
    document.getElementById(`input_subdepartamento_editar`).value = nomesd.textContent;
    document.getElementById(`input_sd_id`).value = sd_id;
    document.getElementById(`input_departamento_editar`).textContent = departamentosd.textContent;
    document.getElementById(`input_departamento_editar`).value = departamentoid;
}

function toggleInputSdClosed() {

    const inputs_cadastro_sd = document.getElementById(`cadastro_sd`);
    const inputs_edit_sd = document.getElementById(`alteracao_sd`);
    
    inputs_cadastro_sd.removeAttribute('hidden');
    inputs_edit_sd.hidden = true;
}
    
    function editar_sd() {
    
    const sd_id = document.getElementById(`input_sd_id`).value;
    const nome = document.getElementById(`input_subdepartamento_editar`).value;
    const departamento = document.getElementById(`input_departamento_editar`).value;
    
    let Data = new FormData();
    const token = document
        .querySelector(`input[name="_token"]`)
        .value;
    Data.append('nome', nome);
    Data.append('departamento_id', departamento);
    Data.append('_token', token);
    
    const url = `/subdepartamentos/${sd_id}/editar`;
    fetch(url, {
        method: 'POST',
        body: Data
    }).then(() => {
        toggleInputSd(sd_id);
        document.getElementById(`subdepartamento-nome-${sd_id}`).textContent = nome;
    });
    location.reload(true);
    }
    
    function ativar_inativar_sd(sd_id, status) {
    if (status == "ativar") {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Sim');
        Data.append('_token', token);
    
        const url = `/subdepartamentos/${sd_id}/ativar_inativar`;
    
        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Sub departamento ativado, clique em ok, para atualizar a página.");
            window.location.href = "/subdepartamentos";
        });
    
    } else {
        let Data = new FormData();
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        Data.append('ativo', 'Não');
        Data.append('_token', token);
    
        const url = `/subdepartamentos/${sd_id}/ativar_inativar`;
    
        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            alert("Sub departamento inativado, clique em ok, para atualizar a página.");
            window.location.href = "/subdepartamentos";
        });
    }
    
    }

    // CAPTACAO

    function toggleInputCp(cp_id) {

        const nomeCp = document.getElementById(`captacao-name-${cp_id}`);
        const inputs_cadastro = document.getElementById(`cadastro_cp`);
        const inputs_edit = document.getElementById(`alteracao_cp`);
    
        inputs_edit.removeAttribute('hidden');
        inputs_cadastro.hidden = true;
    
        document.getElementById(`input_captacao_editar`).value = nomeCp.textContent;
        document.getElementById(`input_cp_id`).value = cp_id;
    
    }
    
    function toggleInputCpClosed() {
        const inputs_cadastro = document.getElementById(`cadastro_cp`);
        const inputs_edit = document.getElementById(`alteracao_cp`);
    
        inputs_cadastro.removeAttribute('hidden');
        inputs_edit.hidden = true;
    }
    
    function editar_cp() {
    
        const cp_id = document.getElementById(`input_cp_id`).value;
        const nome = document.getElementById(`input_captacao_editar`).value;
    
        let Data = new FormData();
        const token = document.querySelector(`input[name="_token"]`).value;
        Data.append('nome', nome);
        Data.append('_token', token);
    
        const url = `/captacao/${cp_id}/editar`;
        fetch(url, {
            method: 'POST',
            body: Data
        }).then(() => {
            toggleInputCp(cp_id);
            document.getElementById(`captacao-name-${cp_id}`).textContent = nome;
        });
        location.reload(true);
    }
    
    function ativar_inativar_cp(cp_id, status) {
        if (status == "ativar") {
            let Data = new FormData();
            const token = document
                .querySelector(`input[name="_token"]`)
                .value;
            Data.append('ativo', 'Sim');
            Data.append('_token', token);
    
            const url = `/captacao/${cp_id}/ativar_inativar`;
    
            fetch(url, {
                method: 'POST',
                body: Data
            }).then(() => {
                alert("Fonte de captação ativada, clique em ok, para atualizar a página.");
                window.location.href = "/captacao";
            });
    
        } else {
            let Data = new FormData();
            const token = document
                .querySelector(`input[name="_token"]`)
                .value;
            Data.append('ativo', 'Não');
            Data.append('_token', token);
    
            const url = `/captacao/${cp_id}/ativar_inativar`;
    
            fetch(url, {
                method: 'POST',
                body: Data
            }).then(() => {
                alert("Fonte de captação inativada, clique em ok, para atualizar a página.");
                window.location.href = "/captacao";
            });
        }
    
    }