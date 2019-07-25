FROM debian

LABEL maintainer="Roger Ndaba"

ENV TS3SERVER_LICENSE=accept
ENV TSV=3.8.0

WORKDIR /home/teamspeak

EXPOSE 9987/udp 10011 30033

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y wget bzip2

RUN wget http://dl.4players.de/ts/releases/$TSV/teamspeak3-server_linux_amd64-$TSV.tar.bz2 && \
    tar -xvf teamspeak3-server_linux_amd64-$TSV.tar.bz2

WORKDIR teamspeak3-server_linux_amd64

ENTRYPOINT sh ts3server_minimal_runscript.sh

#build and run
#docker build -t ex01 . && docker run --rm -p 9987:9987/udp -p 30033:30033 -p 10011:10011 ex01
