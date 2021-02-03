.env оставил специально, для удобства

нужен driver для doctrine (pdo_mysql по умолчанию)

composer install && php vendor/bin/doctrine orm:schema-tool:create && cd public && php -S localhost:80
