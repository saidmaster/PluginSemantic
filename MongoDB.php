<?php

require_once 'MongoDBConnectionDB.php';
include_once 'Proposition.php';

class MongoDB {

    /**
     * string
     */
    private $metadt;
    private $ip;

    /**
     * getMetadt and setter
     */
    function getIp() {
        return $this->ip;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    /**
     * getMetadt and setter
     */
    function getMetadt() {
        return $this->metadt;
    }

    function setMetadt($metadt) {
        $this->metadt = $metadt;
    }

    # constructeur

    public function __construct($metadata, $ip=null) {
        $this->metadt = $metadata;
        $this->ip = $ip;
    }

    # the function of saving data on mongodb data base [ metadata, array syn, array hyper, ip client ]

    public function saveSearch() {

        # If the User Authenticated !!!

        if (is_user_logged_in()) { # testing if the user is logged in 
            # inserting document 
            
            # Getting Id of User 
            $idUser = get_current_user_id();    # getting the user Id 
            $userInfo = wp_get_current_user();  # getting the user global info 
            $userName = $userInfo->last_name;   # getting the user name
            
        } else {
            
            # Getting Id of User 
            $idUser = '';    # getting the user Id 
            $userInfo = '';  # getting the user global info 
            $userName = '';   # getting the user name
            
        }
        
        $proposition = new Proposition($this->metadt);
        $synonymes = $proposition->getPsynonymes();



        # include connection class

        $con = new MongoDBConnectionDB();

        $conClient = $con->getConnectionDB();
        $db = $conClient->db_semantic; # connect to data base db_semantic
        $col = $db->colsem;         # select colsem collection 

        $document = array(# create a new Document 
            "idUser" => "$idUser", # id of the user
            "usr" => "$userName", # user name
            "host" => $this->ip, # ip client 
            "WordSearch" => $_GET['metadata'], # the word entred by the user
            "synonyms" => $synonymes, # array of synonyms
        );

        $collection = $conClient->selectCollection($db, $col); # calling selectCollection function 
        $collection->insertOne($document);  
    }

    public function getUserSearch($idUser, $by) {

        $con = new MongoDBConnectionDB();

        $conClient = $con->getConnectionDB();
        $db = $conClient->db_semantic; # connect to data base db_semantic

        //$conClient->dropDatabase($db);
        
        
        $col = $db->colsem;
        $collection = $conClient->selectCollection($db, $col);

        $arr = $collection->find();

        echo "<table border='1'>"
        . "<tr>"
        . "<th>Id user</th>"
        . "<th>User Name</th>"
        . "<th>Metadata</th>"
        . "<th>IP Client</th>"
        . "<th>Synonyms</th>"
        . "<th>Hypernyms</th>"
        . "</tr>";

        foreach ($arr as $a) {
            
            //echo "<tr><td colspan='4'>".$a['host']."</td></tr>";
            
            if ($by=="id" && $a['idUser'] == $idUser) {
                echo ""
                . "<tr>"
                . "<td>" . $a['idUser'] . "</td>"
                . "<td>" . $a['usr'] . "</td>"
                . "<td>" . $a['WordSearch'] . "</td>"
                . "<td>" . $a['host'] . "</td>"
                . "<td>";
                ?>

                <?php

                # here start looping array of synonyms
                foreach ($a['synonyms'] as $syno) {
                    echo " | " . $syno;
                }
              
            }elseif(strcmp($a['host'],$idUser)==0){
                
                //echo "<tr><td colspan='4'>".strcmp($a['host'],$idUser)."</td></tr>";
                
                echo ""
                . "<tr>"
                . "<td>" . $a['idUser'] . "</td>"
                . "<td>" . $a['usr'] . "</td>"
                . "<td>" . $a['WordSearch'] . "</td>"
                . "<td>" . $a['host'] . "</td>"
                . "<td>";
                ?>

                <?php

                # here start looping array of synonyms
                foreach ($a['synonyms'] as $syno) {
                    echo " | " . $syno;
                }
                echo "</td><td</td>";
            }
        
            
            
        }
        echo "</tr></table>";
    }

}
