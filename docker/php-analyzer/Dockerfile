FROM abdev/php-sec_php-fpm

USER root
RUN apt-get update && apt-get install -y git && apt-get clean
RUN composer global require wapmorgan/php-code-fixer sebastian/phpcpd phploc/phploc jakub-onderka/php-parallel-lint
