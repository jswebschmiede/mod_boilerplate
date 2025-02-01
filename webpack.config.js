const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const ZipPlugin = require('zip-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const webpack = require('webpack');
const chalk = require('chalk');
const logSymbols = require('log-symbols');
const fs = require('fs');
const rimraf = require('rimraf');

let lastPercentage = 0;

const progressHandler = (percentage, message) => {
    // Round to 2 decimal places
    const roundedPercentage = Math.round(percentage * 100);

    // Only output if the percentage has changed
    if (roundedPercentage !== lastPercentage) {
        // Clear console
        process.stdout.write('\x1Bc');

        if (percentage === 0) {
            console.log(chalk.blue(`${logSymbols.info} Build starting...`));
        } else if (percentage === 1) {
            console.log(chalk.green(`${logSymbols.success} Build completed!`));
        } else {
            const progressBar = createProgressBar(roundedPercentage);
            console.log(
                chalk.yellow(
                    `${logSymbols.warning} Progress: ${progressBar} ${roundedPercentage}%`,
                ),
            );
            console.log(chalk.cyan(`${logSymbols.info} Status: ${message}`));
        }

        lastPercentage = roundedPercentage;
    }
};

// Function to create a visual progress bar
const createProgressBar = (percentage) => {
    const width = 20;
    const filledWidth = Math.round(width * (percentage / 100));
    const emptyWidth = width - filledWidth;
    return chalk.green('█'.repeat(filledWidth)) + chalk.gray('█'.repeat(emptyWidth));
};

const cleanDirectories = (directories) => {
    directories.forEach((dir) => {
        if (fs.existsSync(dir)) {
            rimraf.sync(`${dir}/*`);
        }
    });
};

module.exports = (env, argv) => {
    const isProduction = argv.mode === 'production';
    const joomlaPath = path.resolve(__dirname, '../../joomla');

    const copyPatterns = [
        {
            from: 'src/services',
            to: 'services',
        },
        {
            from: 'src/tmpl',
            to: 'tmpl',
        },
        {
            from: 'src/subforms',
            to: 'subforms',
            noErrorOnMissing: true,
        },
        {
            from: 'src/language',
            to: 'language',
        },
        {
            from: 'src/media',
            to: 'media',
            globOptions: {
                ignore: ['**/*.js', '**/*.css'], // Ignores JS and CSS files
            },
        },
        { from: 'src/mod_boilerplate.xml', to: 'mod_boilerplate.xml' },
        { from: 'src/script.php', to: 'script.php' },
    ];

    const directoriesToClean = [
        path.join(joomlaPath, 'modules/mod_boilerplate'),
        path.join(joomlaPath, 'media/mod_boilerplate'),
    ];

    if (!isProduction) {
        console.log(chalk.red(`${logSymbols.error} Cleaning directories...`));

        // Clean directories before build
        cleanDirectories(directoriesToClean);

        copyPatterns.push(
            {
                from: 'dist/mod_boilerplate.xml',
                to: path.join(joomlaPath, 'modules/mod_boilerplate'),
            },
            {
                from: 'dist/services',
                to: path.join(joomlaPath, 'modules/mod_boilerplate/services'),
            },
            {
                from: 'dist/tmpl',
                to: path.join(joomlaPath, 'modules/mod_boilerplate/tmpl'),
            },
            {
                from: 'dist/subforms',
                to: path.join(joomlaPath, 'modules/mod_boilerplate/subforms'),
                noErrorOnMissing: true,
            },
            {
                from: 'dist/media',
                to: path.join(joomlaPath, 'media/mod_boilerplate'),
                noErrorOnMissing: true,
            },
            {
                from: 'dist/language/**/*.ini',
                to: ({ context, absoluteFilename }) => {
                    const relativePath = path.relative(context, absoluteFilename);
                    const parts = relativePath.split(path.sep);
                    const lang = parts[parts.length - 2]; // take the second last part of the path as language code
                    return path.join(joomlaPath, 'language', lang, path.basename(absoluteFilename));
                },
                noErrorOnMissing: true,
                force: true,
            },
        );
    }

    return {
        mode: isProduction ? 'production' : 'development',
        devtool: isProduction ? 'source-map' : 'eval-source-map',
        entry: {
            site: './src/media/js/site.js',
        },
        output: {
            filename: 'media/js/[name].bundle.js',
            path: path.resolve(__dirname, 'dist'),
            clean: true,
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                    },
                },
                {
                    test: /\.css$/,
                    use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader'],
                },
            ],
        },
        plugins: [
            new webpack.ProgressPlugin({
                handler: progressHandler,
                modulesCount: 5000, // Default value
                profile: false, // Disables detailed profiling
            }),
            new MiniCssExtractPlugin({
                filename: 'media/css/[name].min.css',
            }),
            new CopyPlugin({
                patterns: copyPatterns,
            }),
            ...(isProduction
                ? [
                      new ZipPlugin({
                          path: path.resolve(__dirname, 'dist'),
                          filename: 'mod_boilerplate.zip',
                          extension: 'zip',
                          fileOptions: {
                              mtime: new Date(),
                              mode: 0o100664,
                              compress: true,
                              forceZip64Format: false,
                          },
                      }),
                  ]
                : []),
        ],
        optimization: {
            minimizer: [
                // For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`)
                `...`,
                new CssMinimizerPlugin({
                    minimizerOptions: {
                        preset: [
                            'default',
                            {
                                discardComments: { removeAll: true },
                            },
                        ],
                    },
                }),
            ],
            minimize: true,
        },
        stats: 'errors-only', // Shows only errors in the console output
    };
};
