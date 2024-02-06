# GovCMS Testing Docker Images

This repository contains Docker images designed for testing and development with GovCMS. These images are tailored for specific PHP versions and use cases. You can use them to create an environment suitable for testing your GovCMS projects.

## Images Included

### PHP-Apache Images

- `govcmstesting/php:8.2-apache`: PHP 8.2 with Apache web server.
- `govcmstesting/php:8.1-apache`: PHP 8.1 with Apache web server.
- `govcmstesting/php:7.4-apache`: PHP 7.4 with Apache web server.

### PHP-CLI Images

- `govcmstesting/php:8.2-cli`: PHP 8.2 for command-line operations.
- `govcmstesting/php:8.1-cli`: PHP 8.1 for command-line operations.
- `govcmstesting/php:7.4-cli`: PHP 7.4 for command-line operations.

## Usage

### Building Images

You can build these images using the provided Dockerfiles. For example, to build the PHP-Apache image for PHP 8.2, use the following command:

```bash
docker build --tag govcmstesting/php:8.2-apache .
```

### Releasing Images

To release these images, you can use Docker Buildx, which allows you to build and push images for multiple platforms. For instance, to release the PHP-Apache image for PHP 8.2 for various platforms, use the following command:

```bash
docker buildx build --platform linux/amd64,linux/arm64,linux/arm/v7,linux/arm/v8 --tag govcmstesting/php:8.2-apache --push .
```

```bash
docker buildx build --platform linux/amd64,linux/arm64,linux/arm/v7,linux/arm/v8 --tag govcmstesting/php:8.2-cli --push .
```

```bash
docker buildx build --platform linux/amd64,linux/arm64,linux/arm/v7,linux/arm/v8 --tag govcmstesting/ci:8.2-apache --push .
```

Make sure to configure Docker Buildx appropriately to work with multiple platforms.

### Pulling Images

You can pull these images from a container registry using docker pull. For instance, to pull the PHP 8.2 Apache image, use the following command:

```bash
docker pull govcmstesting/php:8.2-apache
```

```bash
docker pull govcmstesting/php:8.2-cli
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.