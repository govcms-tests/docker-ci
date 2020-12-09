# docker-ci

## Build and release images

### Build image

Build php-apache image

```
docker build --tag govcmstesting/php:7.4-apache .
```

### release php-apache image

```
docker push govcmstesting/php:7.4.13-apache
```