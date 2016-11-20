# beer-trip
Visit as many breweries an taste as much :beer: types as possible using 
:helicopter: within defined trip distance.

You can get trip information using console command or accessing web page.

### Console command

To access detailed information about which breweries can be visited and how many 
different types of beer can be allocated console command can be launched.

```
php app/console beertrip:calculate {lat} {lng}
```

### Web page (map)

To view map with marked breweries and trip route web page can be opened.

```
http://localhost:8080/trip/{lat}/{lng}
```

In both ways {lat} and {lng} represents values of starting point latitude and longitude.

### Settings

Trip maximum distance can be changed in `parameters.yml` file under **travel_distance** key.

# Development Notes

### Docker and Docker Compose

To get environment up and running, we need to install **Docker Engine** and **Docker Compose** first.

Docker Engine and Docker Compose installation guides can found here: https://docs.docker.com/compose/install/

### Configuration

When Docker and Docker Compose are installed on machine, we need to make configuration file:

```
cp docker-compose.yml.dist docker-compose.yml
```

After this, container configuration can be adjusted on **docker-compose.yml** file according to your needs.

### Start Docker containers

To start Docker containers just run this command:

```
docker-compose up -d
```
