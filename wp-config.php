<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'nathalie' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

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
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'f1psP!l]k:.bK4]-^ZJ;xA2K%jmgBV%7MDJk]#kt{B-@Ym+WtK;-3(IU8b:wk:[1' );
define( 'SECURE_AUTH_KEY',  ',@[$yon4Zb<f~HLrrUzW9P5yAk*.zKO:|(gz*^CM-ekP/6!5l5kr-#QeY/YN(BdB' );
define( 'LOGGED_IN_KEY',    '@MQ7+V!wPh,BR3f7` C&x#z{;UWI##A^I$ C?a9LSj^-3j1,u#(@Oj_?9:1AqAoN' );
define( 'NONCE_KEY',        'g0LKs$S(x=Tx@h=9[<fwSR3,{7^CtA%9ztl/7SLz1L|};;ES_U#5.l6rZ`BQS.|x' );
define( 'AUTH_SALT',        '4b8PSXm7PTvlj$Pu6 (z:7Yy:237e?7Z9k|)nmnhaR`ksMKIaDEyengckGD9<u&H' );
define( 'SECURE_AUTH_SALT', '#K}L~|rxjnDj@?=(7n)=/]P=&?tjCJbsnb)j&{RkTKJ&|,:=.*4*^ugd-;J8oNq?' );
define( 'LOGGED_IN_SALT',   '17u<b0>}{&N!;a;lfcTe*(<`5g)En)5P]DY!O&&@1poZoQi|fHB_K3+%p!IA(a]c' );
define( 'NONCE_SALT',       '[>w#JG]&^8>P`Rt:+:gSZt;Tm#`6!;-ptwN!<<Gvx7?LE|/<LR?;jeuXL=k9;c`X' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY',false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
