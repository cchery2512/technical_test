FROM node:alpine

COPY ./docker-config/node/start-container.sh /usr/local/bin/start-container.sh
RUN chmod +x /usr/local/bin/start-container.sh

ENTRYPOINT ["start-container.sh"]
