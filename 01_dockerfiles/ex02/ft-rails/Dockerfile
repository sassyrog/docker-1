FROM ruby:2.6

RUN apt-get update && \
	apt-get -f install -y build-essential

ENV RAILS_VERSION 5.0.1
ENV APP_HOME /opt/app
ENV RAILS_ENV=development

RUN mkdir -p $APP_HOME
WORKDIR $APP_HOME

ONBUILD ADD rails_app/Gemfile rails_app/Gemfile.lock $APP_HOME/

ONBUILD RUN bundle install

ONBUILD ADD rails_app $APP_HOME/
