    <?php 
       header('Access-Control-Allow-origin:*');
       header('Access-Control-Allow-Headers:*');
       header('Containt-Type:application/json,charset=UTF-8');

       
    if (isset($_GET['key'])) {
      
    $key=$_GET['key'];
  
    if($key=="98986Z_HCC8765"){   
      
     try {
      //code...
       $db= new PDO('mysql:host=localhost;dbname=livraze','root','',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
       $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     } catch (\Exceptions $e) {
       echo $e->getMessage();
     }
     
    if (isset($_GET['datas'])) {
      $datas=$_GET['datas'];
      if ($datas=="livres") {
        $recup_ds= $db->prepare("SELECT * FROM livres ORDER BY id DESC ");
        $recup_ds->execute();
       $all_datas= $recup_ds->fetchAll(PDO::FETCH_OBJ);
       
       if($all_datas){
        $return["livres"]=$all_datas;
       }else{
         $return['error']="veuillez specifier le type des données aux quelles vous voulez accèder .....";  
       }

        }       
      }
      // elseif(is_numeric($datas)) {
      //   $recup_ds= $db->query("SELECT * FROM livres where id=12 ORDER BY id DESC ");
      //   $recup_ds->execute();
      //   $all_datas= $recup_ds->fetch();
      //   $return["livre"]=$all_datas; 
         
             
      // }

     // elseif($datas=="top5") {
      //   $recup_ds= $db->query("SELECT * FROM livres where id=12 ORDER BY id DESC ");
      //   $recup_ds->execute()
      //   while ($all_datas= $recup_ds->fetch()){
      //   $return[]=$all_datas;     
      //   }       
      // }
     if (isset($_GET['livre'])) {
        $id=$_GET['livre']; 
        if (is_numeric($id)) {
         $query= $db->query("SELECT * FROM livres WHERE id='".$id."'");  
         $livre= $query->fetchAll(PDO::FETCH_OBJ);
         $return=$livre[0];
        }
        elseif (!is_numeric($id)) {
          $return["error"]="id invalid";
        }
        
     }
     elseif (!isset($_GET['datas']) or !isset($_GET['livre'])) {
      $return['error']="veuillez specifier le type des données aux quelle vous voulez accèder .....";  
     }      
    // else        
    //     $return['error']="veuillez specifier le type des données aux quelle vous voulez accèder ....................;;;;;;;;;;;;;;;;;;;;;;;; .....";      
      }    
     
    else{
        $return['error']="Des paramèttre sont manquant veuillez consulter la documentation";
    }      
    

   }
   elseif ($key!="98986Z_HCC8765") {
       $return['error']="Vous n'avez aucune accès à cette API, veuillez contacter l'administrateurs";

    
   }
       
    
    elseif(!isset($_GET['key'])) {
       $return['error']="Desolé Vous n'avez aucune accès à cette API, veuillez contacter l'administrateurs";

    }
     echo json_encode($return);
    ?>
