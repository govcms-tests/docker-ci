# Use the govcmstesting/php:8.2-apache image
FROM govcmstesting/php:8.2-apache

# Copy test files from govcmstesting/tests:3.x-latest to "/app/tests"
COPY --from=govcmstesting/tests:3.x-latest /tests /tests

# Set environment variables
ENV SIMPLETEST_BASE_URL='http://localhost'
ENV SIMPLETEST_DB='sqlite://localhost/sites/default/files/.ht.sqlite'
