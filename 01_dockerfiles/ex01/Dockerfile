FROM alpine

ENV TSV=3.8.0

RUN apk update && \
    apk add bzip2 wget ca-certificates && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN wget https://files.teamspeak-services.com/releases/server/$TSV/teamspeak3-server_linux_amd64-$TSV.tar.bz2


RUN adduser --disabled-login teamspeak