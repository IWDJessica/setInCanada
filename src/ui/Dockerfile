## STAGE 1 build ##
FROM node:12.16.1-alpine3.9 AS build
WORKDIR /usr/src/app
RUN npm install -g @angular/cli@9.1.0
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN ng build --prod --build-optimizer

## STAGE 2 run ##
FROM nginx:1.17.9-alpine

#!/bin/sh https://javaee.ch/2018/10/10/docker-angular-nginx/
COPY nginx.conf /etc/nginx/nginx.conf

## Remove default nginx index page
RUN rm -rf /usr/share/nginx/html/*

# Copy from the STAGE 1
COPY --from=build /usr/src/app/dist/ui /usr/share/nginx/html

EXPOSE 4200 80

ENTRYPOINT ["nginx", "-g", "daemon off;"]
