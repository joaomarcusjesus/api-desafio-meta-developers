import React from 'react'

const Tickets = ({ tickets }) => {
  return (
    <div class="container top">
      <div class="row">
        <div class="col-md-8">
          <div class="-scroll">
            <center><h1>Chamados em aberto</h1></center>
            {tickets.map((ticket) => (
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">#{ticket.code}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">{ticket.responsible}</h6>
                  <p class="card-text">{ticket.body}</p>
                </div>
              </div>
            ))}
          </div>
          <button type="button" class="btn btn-success mt-3">Novo Chamado</button>
        </div>
      </div>
    </div>
  )
};

export default Tickets
