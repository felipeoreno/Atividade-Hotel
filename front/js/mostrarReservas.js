const containerReservas = document.querySelector('#reservas');
const URLReservas = 'http://localhost:8080/apiReservas.php';

function carregarReservas(){
    fetch(URLReservas, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(response => response.json())
        .then(reservas => {
            containerReservas.innerHTML = '';
            const options = {year: 'numeric', month: 'numeric', day: 'numeric'}
            for(let i = 0; i < reservas.length; i++){
                const reserva = reservas[i];
                const date_in = new Date(reserva.check_in);
                const date_out = new Date(reserva.check_out);
                const card = document.createElement('card');
                card.classList.add('col-4');
                card.innerHTML = `
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title col-6">Quarto ${reserva.quarto}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Nome do cliente: ${reserva.cliente}</p>
                        <p class="card-text">Data de check-in: ${date_in.toLocaleDateString(options)}</p>
                        <p class="card-text">Data de check-out: ${date_out.toLocaleDateString(options)}</p>
                    </div>
                </div>
                `;
                containerReservas.appendChild(card);
            }
        })
}

carregarReservas();