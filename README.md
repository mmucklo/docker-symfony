# Easy Docker setup for Symfony development

## Getting Started:

   * Copy env.sample to .env
   * Edit .env and change SYMFONY_ROOT to the right directory (where you find app/ web/ src/ vendor/ etc.)
   * Fork as necessary and modify

# Running

   * docker-compose up
   * http://localhost:8080/
      * (or whatever you set NGINX_PORT to in .env)
      * (If you don't have symfony installed yet, see the [Install symfony](#install-symfony) section)

# Composer

   * docker-compose exec php bash
   * composer.phar <whatever you want>

# Install symfony

   * mkdir src
   * docker-compose exec php bash
   * cd /var/www
   * composer.phar create-project symfony/website-skeleton symfony

# License

MIT
