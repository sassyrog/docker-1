FROM ruby:2.2.0

RUN apt-get update -qq && \
	apt-get -f install -y build-essential

RUN gem install rails --version 4.2.4

ENV APP_HOME /opt/app

RUN mkdir -p $APP_HOME
WORKDIR $APP_HOME

ONBUILD ADD rails_app $APP_HOME

ONBUILD RUN bundle install
