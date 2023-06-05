const form = document.querySelector('#form');
const inputNumero = document.querySelector('#inputNumero');
const inputTipo = document.querySelector('#inputTipo');

function adicionarQuarto(e){
    e.preventDefault()

    const numero = inputNumero.value;
    const tipo = inputTipo.value;
    
    fetch(URLQuartos, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(response => response.json())
        .then(quartos => {
            testeNumero = true;
            for(let i = 0; i < quartos.length; i++){
                const quarto = quartos[i];
                console.log(quarto)
                console.log(i)
                if(numero === quarto.numero){
                    testeNumero = false;
                }
            }

            if(testeNumero){
                console.log("deuserto")
                fetch(URLQuartos, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `numero=${encodeURIComponent(numero)}&tipo=${encodeURIComponent(tipo)}`
                })
                    .then(response => {
                        if(response.ok){
                            console.log("response: ", response)
                            swal("Quarto adicionado", "O quarto foi adicionado com sucesso ao banco de dados", "success");
                            carregarQuartos();
                        } else{
                            console.error('Erro ao adicionar quarto');
                            swal("Erro ao adicionar quarto", "error");
                        }
                    })
            } else{
                console.error('Erro ao adicionar quarto: número de quarto já existe');
                swal("Erro ao adicionar quarto!", "O número de quarto inserido já existe", "error");
            }
        })
}

form.addEventListener('submit', adicionarQuarto);