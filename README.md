# Setup

- Have Docker and Docker Compose installed
- $ git clone https://github.com/uwepries/be-developer-test
- $ cd be-developer-test
- $ cd docker
- $ docker-compose up -d
- $ cd ..
- $ chmod 777 ./src/public/assets/thumb
- $ docker exec -it anwaltde-image-service-app composer install

# Execute Tests
- $ docker exec -it anwaltde-image-service-app ./vendor/bin/phpunit

# Open HTML page in browser
- http://localhost:8000/

# Resize (320x240)
- http://localhost:8000/cat-323262_1920.jpg/resize/width/320/height/240

# Crop (640x480)
- http://localhost:8000/cat-1045782_1920.jpg/crop/width/640/height/480

# Crop with offset (640x480+350+180)
- http://localhost:8000/cat-1045782_1920.jpg/crop/width/640/height/480/x/350/y/180

