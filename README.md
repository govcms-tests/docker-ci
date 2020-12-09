# docker-ci

## Build and release images

### Build images

Build php-apache image

```
docker build --tag govcmstesting/php:7.4-apache .
docker push govcmstesting/php:7.4-apache
```

### Release images

Release php-apache image

```
docker push govcmstesting/php:7.4.13-apache
docker push govcmstesting/php:7.4-apache
```