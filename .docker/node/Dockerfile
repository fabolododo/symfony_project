FROM node:12

LABEL maintainer="Fabrice Latri <fabrice.latri@hotmail.fr>"

WORKDIR /usr/src/app

COPY package*.json ./

RUN npm install

COPY . .

EXPOSE 9000

CMD ["npm", "start"]