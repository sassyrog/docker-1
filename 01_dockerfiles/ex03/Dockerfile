FROM ubuntu:18.04

LABEL maintainer="Roger Ndaba"

RUN apt-get update -q \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -yq --no-install-recommends \
	ca-certificates \
	openssh-server \
	wget \
	apt-transport-https \
	vim \
	nano
