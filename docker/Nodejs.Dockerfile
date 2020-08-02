FROM node

WORKDIR /var/www/socket/

COPY package.json ./

RUN npm install