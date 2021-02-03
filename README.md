.env оставил специально, для удобства

нужен driver для doctrine (pdo_mysql по умолчанию)

<code>composer install && php vendor/bin/doctrine orm:schema-tool:create && cd public && php -S localhost:80</code>

get - http://localhost/
add - http://localhost/add
