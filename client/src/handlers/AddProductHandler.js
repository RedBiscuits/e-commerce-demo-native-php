const typeHandler = {
  dvd: (values) => [{ name: "Size", value: values.size }],
  furniture: (values) => [
    { name: "Width", value: values.width },
    { name: "Height", value: values.height },
    { name: "Length", value: values.length },
  ],
  book: (values) => [{ name: "Weight", value: values.weight }],
};

export default typeHandler;
