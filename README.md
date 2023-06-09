# renzo-castillo

This Wordpress plugin is designed to accomplish the [Vue JS Developer Applicant Challenge for Awesome Motive](https://awesomemotive.com/vuejs-developer-applicant-challenge/) . 

## IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin).

### Type Support for `.vue` Imports in TS

TypeScript cannot handle type information for `.vue` imports by default, so we replace the `tsc` CLI with `vue-tsc` for type checking. In editors, we need [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin) to make the TypeScript language service aware of `.vue` types.

If the standalone TypeScript plugin doesn't feel fast enough to you, Volar has also implemented a [Take Over Mode](https://github.com/johnsoncodehk/volar/discussions/471#discussioncomment-1361669) that is more performant. You can enable it by the following steps:

1. Disable the built-in TypeScript Extension
    1) Run `Extensions: Show Built-in Extensions` from VSCode's command palette
    2) Find `TypeScript and JavaScript Language Features`, right click and select `Disable (Workspace)`
2. Reload the VSCode window by running `Developer: Reload Window` from the command palette.

### Customize configuration

See [Vite Configuration Reference](https://vitejs.dev/config/).

## Project Setup

```sh
npm install
```

* Note: Node 18 is recommended, at least  Node 14 or above.

### Compile and Hot-Reload for Development

```sh
npm run dev
```

* Note: Please keep in mind that if you test  the app with npm run dev, not all the variables that come from Wordpress will be available. 

### Type-Check, Compile and Minify for Production

```sh
npm run build
```

### Run Unit Tests with [Vitest](https://vitest.dev/)

```sh
npm run test:unit
```

### Lint with [ESLint](https://eslint.org/)

```sh
npm run lint
```

### PHP Project Dependencies

````sh
composer install
````
* Note: PHP 8.0 is recommended, at least PHP 7.4 or above

### Wordpress translations

* This plugin has an `es_PE` translation. Consider adding `Español de Perú` to your Wordpress site language to test it. 

## Known issues

* There's not a validation to check if `test_project_option` already exists. The right approach would be to validate its existance and create it with a proper plugin prefix. This hasn't been done yet because I wanted to already deliver the project in order to be reviewed. Thank you for your understanding. 
