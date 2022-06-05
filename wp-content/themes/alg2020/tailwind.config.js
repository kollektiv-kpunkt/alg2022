module.exports = {
  content: require("fast-glob").sync(["./**/*.php", "*.php"]),
  theme: {
    extend: {
        colors: {
            "prim" : "var(--color-primary)",
            "sec" : "var(--color-secondary)",
            "snow" : "var(--color-snow)",
            "grey" : "var(--color-grey)",
            "dark" : "var(--color-dark)",
        },
    },
  },
  plugins: [],
};
