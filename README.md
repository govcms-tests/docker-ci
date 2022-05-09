# docker-ci

## Build and release images

### Build images

Build php-apache image

```
docker build --tag govcmstesting/php:8.1-apache .
docker build --tag govcmstesting/php:7.4-apache .
```

Build php-cli image

```
docker build --tag govcmstesting/php:8.1-cli .
docker build --tag govcmstesting/php:7.4-cli .
```

### Release images

Release php-apache image

```
docker buildx build --platform linux/amd64,linux/arm64,linux/arm/v7 --tag govcmstesting/php:8.1-apache --push .
docker push govcmstesting/php:7.4-apache
```

Release php-cli image

```
docker buildx build --platform linux/amd64,linux/arm64,linux/arm/v7 --tag govcmstesting/php:8.1-cli --push .
docker push govcmstesting/php:7.4-cli
```