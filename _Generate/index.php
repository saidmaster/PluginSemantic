<?php 


$class="Parameter";
if (!$settings = parse_ini_file($class.'.ini', TRUE)) throw new exception('Unable to open ' . $class.'.ini');

 $SUEIL = $settings['database']['SUEIL'];
 $LIMIT = $settings['database']['LIMIT'];
 $WordnetPath = $settings['database']['WordnetPath'];

 $POIDCLICK =$settings['database']['POIDCLICK'];
 $POIDSEARCH = $settings['database']['POIDSEARCH'];
 $POIDCMD = $settings['database']['POIDCMD'];
 $MESURE = $settings['database']['MESURE'];
 $LIMITFREQUENCY = $settings['database']['LIMITFREQUENCY'];
 $LIMITPOID = $settings['database']['LIMITPOID'];
 $SEMANTIC_MESURE = $settings['database']['SEMANTIC_MESURE'];
 $LIMIT_SEMANTIC_PRODUCT = $settings['database']['LIMIT_SEMANTIC_PRODUCT'];
 $LIMIT_Comment_Array = $settings['database']['LIMIT_Comment_Array'];

 $DB_PRO_HOST = $settings['database']['DB_PRO_HOST'];
 $DB_PRO_NAME = $settings['database']['DB_PRO_NAME'];
 $DB_PRO_USER = $settings['database']['DB_PRO_USER'];
 $DB_PRO_PASSWORD = $settings['database']['DB_PRO_PASSWORD'];




$code = "<?php class $class {

    const SUEIL = $SUEIL;
    const LIMIT = $LIMIT;
    const WordnetPath = $WordnetPath;

    # le choix du trois types parametrable Click | search | cmd  Tracking User
    
    const POIDCLICK = $POIDCLICK;
    const POIDSEARCH = $POIDSEARCH;
    const POIDCMD = $POIDCMD;
    const MESURE = $MESURE;
    const LIMITFREQUENCY = $LIMITFREQUENCY;
    const LIMITPOID = $LIMITPOID;
    const SEMANTIC_MESURE = $SEMANTIC_MESURE;
    const LIMIT_SEMANTIC_PRODUCT = $LIMIT_SEMANTIC_PRODUCT;
    const LIMIT_Comment_Array = $LIMIT_Comment_Array;

    # param of sql wordnet
    const DB_PRO_HOST = $DB_PRO_HOST;
    const DB_PRO_NAME = $DB_PRO_NAME;
    const DB_PRO_USER = $DB_PRO_USER;
    const DB_PRO_PASSWORD = $DB_PRO_PASSWORD;

    public function __construct() {
        // Sueil percent value  to accept the similar word.
        define('SUEIL', self::SUEIL);

        // Limit of searched result.
        define('LIMITFREQUENCY', self::LIMITFREQUENCY);

        // Limit of searched result.
        define('LIMITPOID', self::LIMITPOID);

        // Limit of searched result.
        define('LIMIT', self::LIMIT);

        // MESURE of searched result.
        define('MESURE', self::MESURE);

        //Nom of Data Base MySQL wordnet.
        define('DB_PRO_NAME', self::DB_PRO_NAME);
        
         //User of Data Base MySQL wordnet.
        define('DB_PRO_USER', self::DB_PRO_USER);
        
        // Password of Data Base MySQL wordnet.
        define('DB_PRO_PASSWORD', self::DB_PRO_PASSWORD);
        
        // hebergement MySQL wordnet.
        define('DB_PRO_HOST', self::DB_PRO_HOST);

        // Field Name where we have to search.
        define('WordnetPath', self::WordnetPath);

        //Poid 3 types -> click | search  | cmd 
        define(poidClick, self::POIDCLICK);

        define(poidSearch, self::POIDSEARCH);

        define(poidCmd, self::POIDCMD);

        // Sematic Mesurement.
        define('Semantic_mesure', self::SEMANTIC_MESURE);

        //Limit Semanctic product 
        define('Limit_semantic_pro', self::LIMIT_SEMANTIC_PRODUCT);

        // array comment  
        define('Limit_Comment', self::LIMIT_Comment_Array);
    }

}
$class = new $class();
";



file_put_contents("classes/$class.php" ,$code);

//$a = new $class();
//$a->run();



echo "Generation de votre Class a été effectué !! ";
