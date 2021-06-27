# <p align="center"> Dolphiq CRM - Admin dashboard </p>

## Project setup
```sh
cd dolphiq-assessment/dolphiq-web
```

### Environment Configuration 
```sh
cp .env.example .env
```
 #### Add API config details to .env file
```
VUE_APP_API_BASE_URL= <API BASE URL> // http://localhost:8081
VUE_APP_API_CLIENT_ID= <API CLIENT ID> // Passport generated api client id
VUE_APP_API_CLIENT_SECRET=<API CLIENT SECRET> // Passport generated api client seacret
```

### Update dependencies
```sh
yarn install
```

### Compiles and hot-reloads for development
```sh
yarn serve
```
** This will output the local url and port. Visit that url to access the admin pannel

### Compiles and minifies for production
```sh
yarn build
```

### Run your unit tests
```sh
yarn test:unit
```

### Lints and fixes files
```sh
yarn lint
```

### Default login credentials for testing
```sh
Username: admin@dolphiq.org
Password: password
```

### Customize configuration
See VueJs [Configuration Reference](https://cli.vuejs.org/config/).
