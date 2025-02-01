# Boilerplate Module - Joomla Module

## Description

Boilerplate Module is a base module for Joomla, serving as a starting point for developing custom modules. It provides a pre-configured structure and integrates modern development tools for efficient Joomla extension development.

## Features

-   Pre-configured Webpack setup for efficient asset management
-   Integration of Tailwind CSS for modern, responsive styling (optional)
-   Automated build processes for development and production
-   Progress display during the build process
-   Automatic creation of ZIP archives for easy installation
-   Automatic copying of files to your Joomla installation

## Prerequisites

-   Node.js (version 21.5.0 or higher)
-   pnpm (can be installed globally with `npm install -g pnpm`)
-   Joomla 5.x or higher (tested with Joomla 5.0)
-   PHP 8.3 or higher (tested with PHP 8.3)

## Installation

1. Clone the repository:

    ```
    git clone https://github.com/jswebschmiede/mod_boilerplate.git
    ```

2. Navigate to the project directory:

    ```
    cd mod_boilerplate
    ```

3. Install dependencies:

    ```
    pnpm install
    ```

## Usage

### Development Mode

To work in development mode and benefit from automatic reloading and copying the files to your Joomla installation:

-   install the module in Joomla (see Production Mode)
-   configure the `webpack.config.js` file with the path to your Joomla installation (default is `../../joomla`)
-   folder structure should look like this. You can change the names of the folders, important is only the structur itself.

```
joomla_dev/
    - joomla/
    - joomla_components/
        - mod_boilerplate/
```

-   start the development server:

```
pnpm run dev
```

### Production Mode

To create a production-ready version of your module:

```
pnpm run build
```

This creates an optimized version of the module and packages it into a ZIP file for installation in Joomla.

## Project Structure

-   `src/`: Module source code
    -   `src/`: Dispatcher and Helper Classes
    -   `tmpl/`: Template files for the module
    -   `media/`: Assets such as JavaScript and CSS
    -   `services`: Service Provider
    -   `language`: Language files
-   `dist/`: Compiled and optimized files (after build)
-   `webpack.config.js`: Webpack configuration
-   `tailwind.config.js`: Tailwind CSS configuration
-   `package.json`: Project dependencies and scripts

## Customization

You can customize the module by editing the files in the `src/` directory. The main customization points are:

-   replace all occurences of `mod_boilerplate` with your module name, don't forget to change the name in the `package.json` file, the `webpack.config.js` file
-   replace all occurences of `boilerplate` with your module name

## Contributing

Contributions are welcome! Please create a pull request or open an issue for suggestions and bug reports.

## License

MIT License; see LICENSE.txt
