let mix = require("laravel-mix");

mix.disableSuccessNotifications();
mix.setPublicPath(".");
mix.setResourceRoot(".");
mix.webpackConfig({
  externals: {
    jquery: "jQuery",
  },
});
mix.options({
  postCss: [require("autoprefixer")],
  fileLoaderDirs: {
    fonts: "../fonts",
  },
});

mix.babelConfig({
  plugins: ["@babel/plugin-syntax-dynamic-import"],
});

mix.copy("src/images", "dist/images");
mix.copy("src/fonts", "dist/fonts");

mix
  .js("src/js/app.js", "dist")
  .js("src/js/editor.js", "dist")
  .sass("src/scss/app.scss", "dist")
  .sass("src/scss/editor.scss", "dist")
  .options({
    processCssUrls: false,
    postCss: [require("tailwindcss")],
  });

const proxyServer = process.env.BASE_URL ? process.env.BASE_URL : "localhost:4000";
mix.browserSync({
  proxy: proxyServer,
  open: true,
  files: ["*.php", "./parts/*.php", "./blocks/**/*.php"],
  browser: "firefox"
});

mix.webpackConfig(require("./webpack.config"));

if (mix.inProduction()) {
  mix.version();
}