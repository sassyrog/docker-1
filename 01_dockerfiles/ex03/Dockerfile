FROM ubuntu:16.04

LABEL maintainer="Roger Ndaba"

ENV TERM xterm

RUN apt-get update

RUN apt-get update && \
	DEBIAN_FRONTEND=noninteractive \
	apt-get install -y --no-install-recommends \
	wget ca-certificates postfix openssh-server
RUN wget https://packages.gitlab.com/install/repositories/gitlab/gitlab-ce/script.deb.sh && \
	chmod 777 script.deb.sh && \
	./script.deb.sh

RUN EXTERNAL_URL="http://192.168.99.100:8080"

RUN apt-get install -y tzdata gitlab-ce

EXPOSE 443 80 22


CMD (/opt/gitlab/embedded/bin/runsvdir-start &) && \
	gitlab-ctl reconfigure && \
	tail -f /dev/null