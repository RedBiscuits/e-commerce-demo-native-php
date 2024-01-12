import React from "react";
import { useDispatch, useSelector } from "react-redux";
import ProductList from "components/ProductList";
import * as reducer from "controllers/SelectedItemsReducer";
import Navbar from "components/Navbar";
import { MassDeleteButton, AddButton } from "components/NavButtonsFactory";
import Footer from "components/Footer";
import { setProductsData } from "controllers/ProductsReducer.mjs";
import { useEffect , useState } from "react";
import axios from "axios";

const Dashboard = () => {
  const dispatch = useDispatch();
  const [products, setProducts] = useState([]);

  useEffect(() => {
    axios.get("http://localhost:8000").then((res) => {
      console.log(res);
      dispatch(setProductsData(res.data));
      setProducts(res.data ?? []);
    });
  }, [dispatch]);

  const selectedIds = useSelector((s) => s.myFeature);

  const handleCheckboxChange = (productSKU) => {
    const productExists = selectedIds.some(
      (product) => product.sku === productSKU
    );
    if (productExists) {
      dispatch(reducer.removeProduct(productSKU));
    } else {
      dispatch(reducer.addProduct(productSKU));
    }
  };

  console.log("products L : "  , products);

  return (
    <div>
      <Navbar
        rightButton={<MassDeleteButton />}
        leftButton={<AddButton />}
        title={"Product List"}
      />
      <ProductList data={products} onCheckboxChange={handleCheckboxChange} />
      <Footer />
    </div>
  );
};

export default Dashboard;
