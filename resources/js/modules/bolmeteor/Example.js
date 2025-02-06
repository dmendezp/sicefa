import React, { Component } from 'react';
import ReactDOM from 'react-dom';
export default class Example extends Component {
  render() {
    return <div>ejemplo uwu</div>;
  }
}

if (document.getElementById('example2')) {
    ReactDOM.render(<Example />, document.getElementById('example2'));
}