# First stage: Build stage
FROM govcmstesting/tests:3.x-latest AS builder

# Second stage: Final stage
FROM govcmstesting/php:8.2-apache

# Copy Apache configuration file
COPY images/apache/httpd.conf /etc/apache2/sites-available/default.conf

# Enable the default site configuration
RUN a2ensite default

# Copy test files from the build stage
COPY --from=builder /tests /tests

# Set environment variables
ENV PATH=${PATH}:/app/tests/vendor/bin:/app/vendor/bin:/app/bin
ENV SIMPLETEST_BASE_URL='http://local.govcms.gov.au'
ENV SIMPLETEST_DB='sqlite://localhost/sites/default/files/.ht.sqlite'
