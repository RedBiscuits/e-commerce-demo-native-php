import React from "react";
import { Grid } from "@mui/material";
import ProductItem from "./ProductItem";
import { useSelector } from "react-redux";

function ProductList() {
  let data = useSelector((state) => state.products);

  return (
    <Grid
      container
      justifyContent="space-around"
      spacing={2}
      sx={{ marginLeft: "4rem" }}
    >
      {data.map((item) => (
        <Grid item xs={12} sm={6} md={3} key={item.sku}>
          <ProductItem item={item} />
        </Grid>
      ))}
    </Grid>
  );
}

export default ProductList;
