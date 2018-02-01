FROM busybox

ARG USER_PNAME=app
ARG USER_PUID=1000
ARG USER_PGID=1000

RUN adduser -g "" -H -D -G www-data -u $USER_PUID $USER_PNAME

COPY ./project_api/ /var/www
RUN chown -R www-data:www-data /var/www

VOLUME /var/www
WORKDIR /var/www

RUN rm -Rf storage/framework/cache storage/framework/sessions/* \
    storage/framework/cache/* \
    storage/framework/testing/* \
    storage/framework/views/* \
    storage/framework/logs/*

CMD tail -f /dev/null
