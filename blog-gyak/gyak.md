https://github.com/szerveroldali/blog_basic_assets 
composer require laravel/ui
php artisan ui bootstrap --auth
npm i
npm i -D @fortawesome/fontawesome-free
npm run dev


CRUD végpontok - Category modelhez
CRUD = Create, Read (one/all), Update, Delete
Read
    GET /categories //mind lekérése
    GET /categories/:id //egy elem lekérése ID alapján

Create
    POST /categories //kategória létrehozása

Update
    PATCH /categories/:id //részleges módosítás, csak a beküldött mezők
    PUT  /categories/:id //teljes módosítás, minden mező

Delete
    DELETE /categories //mind törlése
    DELETE /categories:id //egy kategória törlése
