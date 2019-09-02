
import React, { Component } from 'react'

const NavBar = () => {
  return (
    <ul class="nav justify-content-center theme">
      <li class="nav-item">
        <a class="nav-link active" href="#">Chamados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Setores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Responsáveis</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Históricos</a>
      </li>
    </ul>
  )
}

export default NavBar;
