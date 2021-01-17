# Test Task Books.Api

  1. Up application 
    ```
    docker-compose up -d
    ```
  2. Install composer
```composer
    docker-compose exec app composer install
```
  3. Migrations
```
docker-compose exec app composer bin/console doctrine:migrations:migrate
```
  ## API Examples:
Run to create the Book
```
POST http://localhost:8090/books/create
BODY: // will create book with only ru name (without default en)
{
    "name": "книга создана по API 15122920",
    "_locale": "ru",
    "author": [5555, 333, 22]
} OR
BODY: // will create book with only en name
{
    "name": "Book created by API",
    "_locale": "en",
    "author": [5555, 333, 22]
} OR
BODY:  // will create book with only en name 
// (By defaultLocale='en' you can change it in .env :
// APP_DEFAULT_LOCALE, available only for one of APP_LOCALES)
{
    "name": "Book created by API",
    "author": [5555, 333, 22]
}
```
Run to create the Author
```
POST http://localhost:8090/authors/create
BODY: 
{
    "name": "Author created by API 100NN"
}
``` 
Run to search a books
```
GET http://localhost:8090/books/search?q=book 333
``` 
Run to get The book by id in en|ru languages
```
GET http://localhost:8090/ru/book/2
``` 
