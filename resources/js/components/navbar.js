
import React, { Component } from 'react'
import brand from '../../img/brand.svg'; // with import


const NavBar = () => {
  return (
    <nav class="menu">
      <ul class="nav list justify-content-center theme">
        <li class="nav-item hero">
          <a class="nav-link active" href="#" title="">
            <img src={brand} width="30" />
          </a>
        </li>
        <hr class="space-white"></hr>
        <li class="nav-item">
          <a class="nav-link active" href="#" title="">
            <i class="fa fa-ticket lga"></i>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#" title="">
            <i class="fa fa-star lga"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#" title="">
            <i class="fa fa-users lga"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#" title="">
            <i class="fa fa-history lga"></i>
          </a>
        </li>
      </ul>
    </nav>
  )
}

export default NavBar;
