import React, { Component } from 'react';

const BodyRow = (props) => {

  const product = props.product
  const currency = props.currency

  return (
    <div className="product flexbox left middle">
      <h4>{product.title}</h4>
      <h4>{product.price}</h4><span className="currency">{currency}</span>
    </div>
  );
}

export default BodyRow;