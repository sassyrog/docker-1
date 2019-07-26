FROM ubuntu:18.04

ENV TERM xterm

RUN apt-get update && \
	apt-get upgrade -y && \
	apt-get install -y ca-certificates \
	openssh-server \
	wget \
	postfix

RUN wget https://packages.gitlab.com/install/repositories/gitlab/gitlab-ce/script.deb.sh && \
	chmod 777 script.deb.sh && \
	./script.deb.sh

RUN apt-get install -y tzdata gitlab-ce

EXPOSE 80 22

ENTRYPOINT (/opt/gitlab/embedded/bin/runsvdir-start &) && \
	gitlab-ctl reconfigure && \
	tail -f /dev/null