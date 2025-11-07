import React, { Component, useState } from 'react';
import ReactDOM from 'react-dom';
import SalesDetails from './cafeto/SalesDetails';
import SearchForm from './cafeto/SearchForm';


export default class Index extends Component {
  constructor(props) {
    super(props);
    this.state = { value: "",  data: [], res: false };
    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
}

handleChange(event) {
    this.setState({ value: event.target.value });
}

  

async handleSubmit(event)  {

    event.preventDefault();

    let result = await fetch(base+`/cafeto/admin/sales/search/${this.state.value}`, {
        method: 'GET'
      });
      if (result != null) {
        let response = await result.json()
        this.setState({ data: response, res: true })

      }
      
      
}

  render() {
   let d = this.state.value;
   let details;
    if ( d != "") {
      details = <SalesDetails  data={this.state.data} />;
    } else{
      // null
    } 

    return ( <div>
        <SearchForm handleSubmit={this.handleSubmit} value={this.state.value} handleChange={this.handleChange} />
        {details}
    </div>
    );
  }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Index />, document.getElementById('example'));
}
