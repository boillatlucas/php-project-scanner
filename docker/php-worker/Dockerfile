FROM abdev/php-sec_php-master

COPY ./crontab /etc/cron.d
RUN chmod -R 644 /etc/cron.d
RUN service cron restart

USER root
RUN apt-get update && apt-get install -y git && apt-get clean
RUN composer global require wapmorgan/php-code-fixer sebastian/phpcpd phploc/phploc jakub-onderka/php-parallel-lint
COPY ./php-analyzer.ini /usr/local/etc/php/conf.d

CMD cron && php-fpm
