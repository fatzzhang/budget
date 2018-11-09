const path = require("path");
const config = require("./webpack.config.js");

config.mode = 'development';
config.devServer = {
  contentBase: path.join(__dirname, '../dist'),
  open: true,
  // compress: true,
  port: 9000
}


module.exports = config;