<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'ensemble' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'amaury' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'Tc5v93KK' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'o6P4)( XK&(;^B@XhO0NM-GTsdU.fDu?(nUZwW}AN8uJMOM-p&iN5cRX8Rpwvj#!' );
define( 'SECURE_AUTH_KEY',  '82!jv~2iR.`r6.BHt6 >J-P.B/a#JQ,@r?T~TlM8?aMo{rhQ|GHwO kWUvSr4!./' );
define( 'LOGGED_IN_KEY',    'Gd^>K1)]8@*0*--UTPys_x[BcD2R>P_yPPQd^t5qiE6|hBNIfxA6REUF6gN}&ZP;' );
define( 'NONCE_KEY',        'k{Z$Y}A2_TF?Q1~Z.E=k6-pVo=tMrHD~[fJ>-7=i*U6B*d{YPVcoSni;<qZ9+Ho=' );
define( 'AUTH_SALT',        'do~FW2)/}3dY@<q!!Q^l|B<WJ] {N.m*$>It!d7Iz9J;_;!~czs7fyqzN`TZW>pz' );
define( 'SECURE_AUTH_SALT', '{wnb-HC6_i5i:.2|xj|I1{,U8g@}yI:Ll{0{J}I$FMdXu .kj*Ay<?1u9:+0JD/b' );
define( 'LOGGED_IN_SALT',   '&=@g#Z2}BAx;Q=tGw8Q&-:|qm*vu%-.(dk$~.L6!aC=Ebueb)p~t{$sm/0qcRLSA' );
define( 'NONCE_SALT',       'NO>>#DTTUUF=H@2!9C6ah:fTbaR22HC;Qtt7w=cyeDR:u8G[UoD5?qySu-@3X_^h' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_ensembe';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');

