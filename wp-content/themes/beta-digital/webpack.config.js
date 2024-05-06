const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const isDevelopment = process.env.NODE_ENV !== 'production';
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

module.exports = {
    devtool: isDevelopment ? 'eval-source-map' : 'source-map',
    entry: {
        'admin': [
          path.resolve(__dirname, 'resources/scripts/admin', 'index.js'),
          path.resolve(__dirname, 'resources/styles/admin', 'styles.scss')
        ],
        'frontend': [
          path.resolve(__dirname, 'resources/scripts/frontend', 'index.js'),
          path.resolve(__dirname, 'resources/styles/frontend', 'styles.scss')
        ]
    },
    output: {
        path: path.resolve(__dirname, 'dist/scripts'),
        filename: '[name]-bundle.js'
    },
    resolve: {
        extensions: ['.js', '.jsx', '.scss']
    },
    module: {
        rules: [
          // js babelization
          {
            test: /\.(js|jsx)$/,
            exclude: /node_modules/,
            loader: 'babel-loader'
          },
          // sass compilation
          {
            test: /\.(sass|scss)$/,
            use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
          },
          // loader for webfonts (only required if loading custom fonts)
          {
            test: /\.(woff|woff2|eot|ttf|otf)$/,
            type: 'asset/resource',
            generator: {
              filename: './resources/styles/font/[name][ext]',
            }
          },
          // loader for images and icons (only required if css references image files)
          {
            test: /\.(png|jpg|gif)$/,
            type: 'asset/resource',
            generator: {
              filename: './resources/images/[name][ext]',
            }
          },
        ]
      },
    
      plugins: [
        // clear out build directories on each build
        new CleanWebpackPlugin({
          cleanOnceBeforeBuildPatterns: [
            '../dist/scripts/*',
            '../dist/styles/*'
          ]
        }),
        // css extraction into dedicated file
        new MiniCssExtractPlugin({
          filename: '../styles/[name].css'
        }),
      ],
      optimization: {
        // minification - only performed when mode = production
        minimizer: [
          // js minification - special syntax enabling webpack 5 default terser-webpack-plugin 
          `...`,
          // css minification
          new CssMinimizerPlugin(),
        ]
      },
    devServer: {
        devMiddleware: {
          writeToDisk: true
        }
    }
}