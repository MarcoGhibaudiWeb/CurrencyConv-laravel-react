import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import TableMaker from './TableMaker';
import './../../css/app.css';


/* Main Component */
class Main extends Component {

  constructor() {

    super();
    this.state = {
      xml: [],
      currency: 'GBP'
    }

    this.handleToggleCurrency = this.handleToggleCurrency.bind(this);
  }
  componentDidMount() {   
    this.loadXml(this.state.currency);  
  }

  loadXml (currency){
    $.ajax({
      url: '/api/xml?'+currency,
      type: "GET",
      success: function(xml) {
          this.setState({ xml });
      }.bind(this),
      error: function(xhr, status, err) {
          console.log('error');
      }.bind(this)
      });
  }

  handleToggleCurrency(event){
    this.setState ({currency : event.target.value})
    this.loadXml(event.target.value);
  }

  render() {
    return (
      <div >      
         <TableMaker onUpdate = {this.handleUpdate} currencyCode = {this.state.currency} handleChange={this.handleToggleCurrency} xml={this.state.xml}/> 
      </div>
    );
  }
}

export default Main;

if (document.getElementById('root')) {
  ReactDOM.render(<Main />, document.getElementById('root'));
}

