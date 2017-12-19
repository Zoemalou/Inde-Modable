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
define('DB_NAME', 'indemodable');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'groupe1');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'indecrotablegroupe1');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '#0m.}vu._Wr-bdH UTj44K@UrvjSjty=e-2fqI@<?K^G2|lbA|_iP)TI1q-boL6q');
define('SECURE_AUTH_KEY',  '~uImwpa; u35(i6hy8jCSWidaI$nQ*+9A.T]^R?:6C{A!jeZ@Y=JVe]4x{BYJ.],');
define('LOGGED_IN_KEY',    'dKEiU&f~[;NQ!&GAK^A}rszT]OK$W?`g,Kln[q8r#OC-K%}My9Na0uS(=k`m^4W_');
define('NONCE_KEY',        ',0M|Gs))(<!|g7zrW!r@LX?Vou~B6ob0cVh;4?u6Aw~<HjwU-D|V6Y^tr2Q0Pfy8');
define('AUTH_SALT',        'k}8.;hX2#fDqdRg5j9XnQ O3z-},)AV7q>-L=#i,SF$]b<k*U!MCIkdY^;mL0k_]');
define('SECURE_AUTH_SALT', 'c=[M8>WTs^oJRqQKzh,vOOlCF{Hk+i@m^ZgC3XzwmLVTjR0@MXCOg)9BCo@X.s.t');
define('LOGGED_IN_SALT',   'yuryUh2zPtU^~#Aod$=`ZTN|jk]MR%-wkv[: xx+khHk{mQq,6)wJeKbY(SM7$sK');
define('NONCE_SALT',       'fb%I g14X%j~;^13Y,a]P%?5&J{IYTFu;ZBV$#/@WF=fSp#Fl]xF%ss[.}e*OhSJ');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'inm_';

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

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');