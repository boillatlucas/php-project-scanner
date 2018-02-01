#!/usr/bin/env bash

REPOSITORY_TAG="abdev/php-sec_code"

docker build -t ${REPOSITORY_TAG} .
docker push ${REPOSITORY_TAG}
