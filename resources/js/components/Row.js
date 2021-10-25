import React, { Component } from 'react';
import BodyRow from './BodyRow';



const Row = (props) => {
  const order = props.order
  const products = [];
  for (const key in order.products) {
    for (const key2 in order.products[key]) {
      var productKey = 'product' + key2
      products.push(<BodyRow key={productKey} product={order.products[key][key2]['@attributes']} currency={order.currency} />)
    }
  }

  return (
    <div className="order active tab flexbox right wrap">
      <div className="tab_header flexbox between">
        <h4>Order Id : {order.id}</h4>
        <h4>{order.date}</h4>
      </div>
      <div className="tab_body">
        <div className="products_list">
          {products}
        </div>
      </div>
      <div className="order_total">
        <h4>Total</h4>
        <h4>{order.total}</h4>
      </div>

    </div>

  );
}

export default Row;