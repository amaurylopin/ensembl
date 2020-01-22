echo "installation de wp-cli"
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
clear
echo "Téléchargement de Wordpress"
curl -O https://fr.wordpress.org/latest-fr_FR.zip
clear
echo "Dezippage de Wordpress"
unzip latest-fr_FR.zip
clear
cd wordpress
mv * ../
cd ..
rm latest-fr_FR.zip
rm -rf wordpress
echo "création de la BDD"
read -p "Quel est le nom de la BDD ?" bdd
echo "ok, je créé la bdd $bdd"
mysql -e "CREATE DATABASE $bdd;"
echo "Base de donnée $bdd créée"
mysql -e "SHOW DATABASES;"
echo "Mise en place des privilèges"
mysql -e "GRANT ALL PRIVILEGES ON $bdd.* TO  'amaury'@'localhost';"
clear
echo "Privilèges accordés"
clear
echo "ok tout est bon pour le moment"
clear
echo "installation de wordpress"
wp --allow-root core config --dbhost=localhost --dbname=$bdd --dbuser=amaury --Tc5v93KK --dbprefix=wp_$bdd_ --skip-check --extra-php <<PHP
define( 'WP_DEBUG', true );
PHP
wp --allow-root core install --url="lopin.io/$bdd" --title="$bdd" --admin_user=alopin --admin_email=amaury@lopin.io --admin_password="$Amaury1991"  <<PHP
define( 'WP_DEBUG', true );
PHP

