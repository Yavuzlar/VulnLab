FROM ubuntu:20.04
MAINTAINER Yavuzlar Web Security Team <iletisim@siberyavuzlar.com>
LABEL Description="Web Vulnerability Lab by Yavuzlar." \
	License="Mozilla Public License Version 2.0" \
	Usage="docker run -d -p [HOST PORT NUMBER]:80 yavuzlar/vulnlab" \
	Version="1.0"

ENV TZ=Asia/Turkey
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt update
RUN apt install -y tzdata

RUN apt-get install -y zip unzip
RUN apt-get install -y \
	php \
	php-cgi \
	php-cli \
	php-common \
	php-curl \
	php-dev \
	php-json \
	php-mbstring \
	php-mysql \
	php-odbc \
	php-phpdbg \
	php-sqlite3
RUN apt-get install apache2 libapache2-mod-php -y
RUN apt-get install mariadb-common mariadb-server mariadb-client -y
RUN apt-get install -y dos2unix
RUN apt-get install -y netcat-traditional

ENV LOG_STDOUT **Boolean**
ENV LOG_STDERR **Boolean**
ENV LOG_LEVEL warn
ENV ALLOW_OVERRIDE All
ENV DATE_TIMEZONE UTC
ENV TERM dumb

RUN rm -rf /var/www/html/index.html
COPY ./app/ /var/www/html
COPY run.sh /usr/sbin/

RUN a2enmod rewrite
RUN chmod +x /usr/sbin/run.sh
RUN chown -R www-data:www-data /var/www/html
RUN apt-get install iputils-ping -y
RUN apt-get install wget -y
RUN apt install net-tools -y


RUN dos2unix /usr/sbin/run.sh

EXPOSE 80

CMD ["/usr/sbin/run.sh"]

