import React from 'react'

const Tickets = ({ tickets }) => {
  return (
    <section class="pl-table">
      <div class="section-title">
        Últimos Chamados
        <br></br>
        <small><b>Total</b>: {tickets.length} </small>
      </div>
      <table class="pl-table__body--desktop col-12">
        <tr class="pl-table__labels" >
          <td class="pl-table__cod">
              #
          </td>
          <td>
              Cliente
          </td>
          <td>
             Setor
          </td>
          <td>
            Status
          </td>
          <td>
            Ações
          </td>
        </tr>
        {tickets.map(ticket => (
          <tr class="pl-table__item">
            <td>{ ticket.reference }</td>
            <td>{ ticket.client }</td>
            <td>{ ticket.sector }</td>
            <td>{ ticket.status }</td>
            <td>
              <i class="fa fa-ellipsis-v lga icon"></i>
            </td>
          </tr>
        ))}
      </table>
    </section>
  )
};

export default Tickets
