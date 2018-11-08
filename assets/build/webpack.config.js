const path = require("path");
const src = path.resolve(__dirname, "../src");
const dist = path.resolve(__dirname, '../dist');


module.exports = {
  entry: path.join(src, "js/index.js"),
  output: {
    path: dist,
    filename: "bundle.js"
  }
}