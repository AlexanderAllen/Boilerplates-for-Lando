lando destroy -y

docker container stop $(docker container ls -q --filter name="landoproxy*")
docker container rm $(docker container ls -q -a --filter name="landoproxy*")

docker system prune

# Remove any traefik proxy caching, just in case it gets confused with docker networks.
rm -rf /home/wsl/.lando/proxy
