FROM ubuntu:18.04

ENV USER=root

RUN apt-get update -y && \
	apt-get upgrade -y && \
	apt-get install git build-essential gcc build-essential  wget -y

RUN wget https://dl.gogs.io/0.11.66/gogs_0.11.66_linux_amd64.tar.gz && \
	tar -xvf gogs_0.11.66_linux_amd64.tar.gz

WORKDIR /gogs

EXPOSE 3000
EXPOSE 8022

ENTRYPOINT ./gogs web

# ENV TERM xterm

# RUN apt-get update && \
# 	apt-get upgrade -y && \
# 	apt-get install -y ca-certificates \
# 	openssh-server \
# 	wget \
# 	postfix

# RUN wget https://packages.gitlab.com/install/repositories/gitlab/gitlab-ce/script.deb.sh && \
# 	chmod 777 script.deb.sh && \
# 	./script.deb.sh

# RUN apt-get install -y tzdata gitlab-ce

# EXPOSE 80 22

# ENTRYPOINT (/opt/gitlab/embedded/bin/runsvdir-start &) && \
# 	gitlab-ctl reconfigure && \
# 	tail -f /dev/null