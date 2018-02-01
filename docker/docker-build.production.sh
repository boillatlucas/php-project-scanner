#!/usr/bin/env bash

YELLOW='\033[0;93m'
GREEN='\033[0;32m'
NC='\033[0m'
DEFINED_CONTAINERS=("mysql" "php-fpm" "rabbitmq" "nginx" "php-analyzer")
REPOSITORY_BASE="abdev/php-sec_"

build()
{
    printf "${GREEN}Build containers${NC}\n"
    for container in "${@}";
    do
        printf "\n\t${YELLOW}- Build container: ${container}${NC}"
        printf "\n\t${YELLOW}- Execute: docker build -t ${REPOSITORY_BASE}${container} ${container}${NC}\n\n"
        docker build -t ${REPOSITORY_BASE}${container} ${container}
    done
}

push()
{
    printf "${GREEN}Push containers${NC}\n"
    for container in "$@";
    do
        printf "\n\t${YELLOW}- Push container to: ${REPOSITORY_BASE}${container}${NC}\n"
        docker push ${REPOSITORY_BASE}${container}
    done
}

printf "${GREEN}Builder container (-h to see usage) ${NC}\n"

while getopts "hb:Bp:P" option; do
  case $option in
    h)
      printf "\n${YELLOW}Usage:${NC}"
      printf "\n\t${YELLOW}-b to build container (name of directory is required)${NC}"
      printf "\n\t${YELLOW}-B to build all containers${NC}"
      printf "\n\t${YELLOW}-p to push container to repository (need to be login, name of directory is required)${NC}\n"
      printf "\n\t${YELLOW}-P to push all containers to repository (need to be login)${NC}"
      ;;
    b)
      build "${OPTARG}"
      ;;
    B)
      build "${DEFINED_CONTAINERS[@]}"
      ;;
    p)
      push "${OPTARG}"
      ;;
    P)
      push "${DEFINED_CONTAINERS[@]}"
      ;;
  esac
done
