'use strict';

const limparFormulario = (cnpj) =>{
    document.getElementById('razaosocial').value = '';
}



const preencherFormulario = (empresa) =>{
    document.getElementById('razaosocial').value = empresa.nome;
}


const pesquisarCnpj = async() => {
    limparFormulario();
    
    let cnpj = document.getElementById('cnpj').value;
    cnpj = cnpj.split("").filter(n => (Number(n) || n == 0)).join("");

    $.ajax({
        'url':'https://www.receitaws.com.br/v1/cnpj/'+cnpj,
        'type': "GET",
        'dataType': 'jsonp',
        'success' : function(empresa){
            if(empresa.abertura){
                preencherFormulario(empresa)
                console.log(empresa);
            }else{
                alert("Erro na busca do CNPJ, verifique se o mesmo está correto ou aguarde um minuto.")
            }
        }
    })

    
     
}

document.getElementById('cnpj')
        .addEventListener('change',pesquisarCnpj);


