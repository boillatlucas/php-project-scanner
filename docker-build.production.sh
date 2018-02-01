#!/usr/bin/env bash

CURRENT=$PWD

cd ./docker
./docker-build.production.sh -B -P
cd $CURRENT
./docker-build.code.sh
