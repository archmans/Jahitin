FROM node:16-alpine as builder

WORKDIR /spa-jahitin

ENV PATH /spa-jahitin/node_modules/.bin:$PATH

COPY package*.json .
COPY vite.config.ts .
COPY tsconfig.json .

RUN npm cache clean --force
RUN npm install
COPY . .
EXPOSE 3000
CMD ["npx", "vite", "--host", "0.0.0.0"]