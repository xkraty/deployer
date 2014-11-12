if type php > /dev/null; then
  sudo apt-get update -qq 
  sudo apt-get install -y -qq libssh2-1-dev libssh2-php
  pecl install -f ssh2-beta < .noninteractive
  php -m | grep ssh2
fi  

composer self-update
composer install --dev

echo `whoami`":1234" | sudo chpasswd
