import React from "react";
import { useDispatch, useSelector } from "react-redux";
import ProductList from "components/ProductList";
import * as reducer from "controllers/SelectedItemsReducer";
import Navbar from "components/Navbar";
import { MassDeleteButton, AddButton } from "components/NavButtonsFactory";
import Footer from "components/Footer";
import { setProductsData } from "controllers/ProductsReducer.mjs";
import { useEffect, useState } from "react";
import axios from "axios";

const Dashboard = () => {
  const dispatch = useDispatch();

  useEffect(() => {
    axios.get("http://195.35.48.130:8000").then((res) => {
      console.log(res);
      dispatch(setProductsData([]));
      dispatch(setProductsData(res.data));
    });
  }, [dispatch]);

  return (
    <div>
      <Navbar
        rightButton={<MassDeleteButton />}
        leftButton={<AddButton />}
        title={"Product List"}
      />
      <ProductList />
      <Footer />
    </div>
  );
};

export default Dashboard;
