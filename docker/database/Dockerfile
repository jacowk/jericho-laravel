FROM mysql

MAINTAINER Jaco Koekemoer <jaco.wk@gmail.com>

LABEL Description="Ubuntu Apache2 PHP7 installation" Vendor="jericho" Version="1.0"

# Update APT-GET
RUN apt-get update

# Install nano
RUN apt-get -y install nano

# Start MySQL
CMD service mysql start

# Expose port
EXPOSE 3306

# Create root user
#ADD create_user.sh /tmp/create_user.sh
#CMD ls -l /tmp/create_user.sh
#CMD chmod 775 /tmp/create_user.sh
#CMD ls -l /tmp/create_user.sh
#RUN /tmp/create_user.sh
