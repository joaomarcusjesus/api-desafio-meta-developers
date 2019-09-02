require('./bootstrap');

import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import Tickets from './components/tickets';
import Navbar from './components/navbar';

class App extends Component {

  constructor(props) {
    super(props);
    this.state = {
      tickets: []
    };
  }

  render() {
    return (
      <Tickets tickets={this.state.tickets} />
    )
  }

  componentDidMount() {
    fetch('http://localhost:8000/api/v1/calls')
      .then(res => res.json())
      .then((data) => {
        console.log(data)
        this.setState({ tickets: data.data })
      })
      .catch(console.log)
  }
}

export default App

const navbar = document.getElementById('navbar')

if (navbar) {
  ReactDOM.render(<Navbar />, document.getElementById('navbar'))
}

ReactDOM.render(<App />, document.getElementById('app'))

