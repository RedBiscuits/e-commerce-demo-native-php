import React, { useState } from "react";
import {
  Checkbox,
  FormControlLabel,
  FormGroup,
  Typography,
  useTheme,
} from "@mui/material";

function ProductItem({ item }) {
  const theme = useTheme();
  const [isChecked, setIsChecked] = useState(false);

  let attributes = "";
  if (item.attributes.length === 1) {
    attributes = item.attributes
      .map((attribute) => attribute.name + " : " + attribute.value)
      .join(" ");
  } else {
    attributes =
      "WxHxL : " + item.attributes.map((attribute) => attribute.value).join("");
  }

  const handleCheckboxChange = () => {
    setIsChecked((prevChecked) => !prevChecked);
  };

  return (
    <div>
      <FormGroup
        sx={{
          display: "flex",
          bgcolor: theme.palette.grey[100],
          position: "relative",
          padding: "1.5rem",
          width: "14rem",
          height: "11rem",
          border: `2px solid ${theme.palette.secondary[500]}`,
          marginTop: "1.5rem",
        }}
      >
        <FormControlLabel
          sx={{ position: "absolute", top: 8, left: 13 }}
          control={
            <Checkbox
              id={item.sku}
              className="delete-checkbox"
              color="primary"
              checked={isChecked}
              datakey={item.sku}
              onChange={handleCheckboxChange}
              sx={{
                width: "100%",
                height: "100%",
                color: theme.palette.primary[500],
              }}
            />
          }
          label=""
        />
        <div style={{ flex: 1, marginLeft: "1rem", marginTop: "1.2rem" }}>
          <Typography
            sx={{ color: theme.palette.primary[500], textAlign: "center" }}
          >
            {" "}
            {item.sku}
          </Typography>
          <Typography
            sx={{ color: theme.palette.primary[500], textAlign: "center" }}
          >
            {" "}
            {item.name}
          </Typography>
          <Typography
            sx={{ color: theme.palette.primary[500], textAlign: "center" }}
          >
            {" "}
            {item.price + "$"}
          </Typography>
          <Typography
            sx={{ color: theme.palette.primary[500], textAlign: "center" }}
          >
            {attributes}
          </Typography>
        </div>
      </FormGroup>
    </div>
  );
}

export default ProductItem;
