const path = require("path");
const HtmlWebpackPlugin = require('html-webpack-plugin');

const src = path.resolve(__dirname, "../src");
const dist = path.resolve(__dirname, '../dist');


module.exports = {
  entry: {
    main: path.join(src, "js/index.js"),
  },
  output: {
    path: dist,
    filename: "[name].[contenthash].bundle.js"
  },
  module: {
    rules: [{
      test: /\.scss$/,
      use: ['style-loader', 'css-loader', 'sass-loader']
    }, {
      test: /\.css$/,
      use: ['style-loader', 'css-loader']
    }]
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: path.join(src, 'html/index.html'),
      filename: 'index.html',
    })
  ]
}