import React from 'react';
import { Grid } from '@mui/material';
import ProductItem from './ProductItem';

function ProductList({ data, onCheckboxChange }) {
  return (
    <Grid container justifyContent='space-around' spacing={2} sx={{ marginLeft: '4rem' }}>
      {data.map((item) => (
        <Grid item xs={3} sm={3} md={2} key={item.sku}>
          <ProductItem item={item} onCheckboxChange={() => onCheckboxChange(item.sku)} />
        </Grid>
      ))}
    </Grid>
  );
}

export default ProductList;