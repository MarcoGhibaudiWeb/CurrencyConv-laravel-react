import React from 'react';
import Row from './Row';

const TableMaker = ({ handleChange, currencyCode, xml }) => {
  const order = [];

  for (const key in xml.order) {
    var orderKey = 'order' + key;
    order.push(<Row key={orderKey} order={xml.order[key]} />)
  }

  return (
    <section className="section flexbox center wrap">
      <h1 className="title"> Currency Converter</h1>
      <div className="orders flexbox center " >
        <div className="container">
          {order}
        </div>
      </div>
      <form>
        <select name='currency' value={currencyCode} onChange={handleChange}>
          <option value="GBP">GBP</option>
          <option value="EUR">EUR</option>
        </select>
      </form>
    </section>
  );
}

export default TableMaker;