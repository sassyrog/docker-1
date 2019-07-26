FROM node:12.7

LABEL maintainer="Roger Ndaba"

ENV NODE_APP_PATH /var/www/node-app

RUN apt-get update -y && \
	apt-get install -y apt-transport-https
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt update -y && \
	apt install -y yarn

WORKDIR $NODE_APP_PATH

COPY node-app $NODE_APP_PATH/

RUN yarn install

CMD ["yarn", "run", "start"]
