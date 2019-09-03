
import React, { Component } from 'react'

const Dashboard = () => {
  return (
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="tt-card">
            <div class="score-blue">Abertos</div>
            <header class="text-center">
              <h6>150</h6>
            </header>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="tt-card">
            <div class="score-blue">Em andamento</div>
            <header class="text-center">
              <h6>22</h6>
            </header>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="tt-card">
            <div class="score-blue">Fechados</div>
            <header class="text-center">
              <h6>312</h6>
            </header>
          </div>
        </div>
      </div>
    </div>
  )
}

export default Dashboard;
