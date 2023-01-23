    <?php 
      header('Containt-Type:application/json');
      $livres=array("1"=>"livres","2"=>"livres","3"=>"livres","4"=>"livres");
      echo json_encode($livres);
    ?>
