# AutoGraphQL

## Run Saleor script to fetch queries
`docker exec -it saleor-platform_api_1 /bin/bash`
`python3 manage.py fetch_all_query_entries`
`exit`
`docker cp d63fc617e705:/app/queries  ~/sites`

## Install correct dependencies
- Add directory where all test-files will run
- Add composer.json-file with following code:
`{
  "name": "saleor/saleor",
  "require": {
    "guzzlehttp/guzzle": "^6.0",
    "phpunit/phpunit": "^9.5.6"
  },
  "autoload": {
    "psr-4": {
      "App\\": "src/"
    }
  }
}`
- Run `composer update`
- Install PHPUnit by using Homebrew