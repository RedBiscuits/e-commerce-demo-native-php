import React from "react";
import { deleteProduct } from "controllers/ProductsReducer.mjs";
import { removeProduct } from "controllers/SelectedItemsReducer";
import axios from "axios";
import { useDispatch, useSelector } from "react-redux";
import CustomButton from "./CustomButton";
import { useNavigate } from "react-router-dom";
import { validateInput } from "controllers/AddProductController";
import { addProduct } from "controllers/AddProductController";
import { addProductReducer } from "controllers/ProductsReducer.mjs";
import { useEffect } from "react";
import { setProductsData } from "controllers/ProductsReducer.mjs";

export const AddButton = () => {
  const navigate = useNavigate();

  const handleAddClick = () => {
    navigate("/addproduct");
  };
  return <CustomButton text={"ADD"} onClick={handleAddClick}></CustomButton>;
};

export const CancelButton = () => {
  const navigate = useNavigate();

  const handleCancelClick = () => {
    navigate("/");
  };
  return (
    <CustomButton text={"Cancel"} onClick={handleCancelClick}></CustomButton>
  );
};

export const SaveButton = ({ formik }) => {
  const products = useSelector((state) => state.products);
  const navigate = useNavigate();

  const handleSaveClick = () => {
    try {
      validateInput(formik);
      const productExists = products.some(
        (product) => product.sku === formik.values.sku
      );
      if (productExists) {
        throw new Error("SKU must be unique.");
      }
      const res = addProduct(formik.values);
      if (res) {
        navigate("/");
      } else {
        throw new Error("Invalid data.");
      }
    } catch (err) {
      alert(err);
    }
  };
  return <CustomButton text={"Save"} onClick={handleSaveClick}></CustomButton>;
};

export const MassDeleteButton = () => {
  const dispatch = useDispatch();
  const selectedIds = useSelector((s) => s.myFeature);
  const handleMassDeleteClick = () => {
    axios
      .post(
        "http://195.35.48.130:8000/delete-products",
        {
          ids: selectedIds.map((product) => product.sku),
        },
        {
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
        }
      )
      .then((res) => {
        axios.get("http://195.35.48.130:8000").then((res) => {
          console.log(res);
          dispatch(setProductsData([]));
          dispatch(setProductsData(res.data));
        });
      });
  };
  return (
    <CustomButton
      text={"MASS DELETE"}
      onClick={handleMassDeleteClick}
    ></CustomButton>
  );
};
