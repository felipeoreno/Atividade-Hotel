const containerQuartos = document.querySelector('#quartos');

const URLQuartos = 'http://localhost:8080/apiQuartos.php';

function carregarQuartos(){
    fetch(URLQuartos, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(response => response.json())
        .then(quartos => {
            containerQuartos.innerHTML = '';

            for(let i = 0; i < quartos.length; i++){
                const quarto = quartos[i];
                if(quarto.disponivel){
                    const card = document.createElement('card');
                    card.classList.add('col-4');
                    card.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Quarto ${quarto.numero}</h5>
                            <p class="card-text">${quarto.tipo}</p>
                            <p class="card-text">Quarto disponível</p>
                        </div>
                    </div>
                    `;
                    containerQuartos.appendChild(card);
                } else{
                    const card = document.createElement('card');
                    card.classList.add('col-4');
                    card.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Quarto ${quarto.numero}</h5>
                            <p class="card-text">${quarto.tipo}</p>
                            <p class="card-text">Quarto indisponível</p>
                        </div>
                    </div>
                    `;
                    containerQuartos.appendChild(card);
                }
            }
        })
}

carregarQuartos();