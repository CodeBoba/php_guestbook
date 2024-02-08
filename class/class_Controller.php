<?php
class Controller{
    public function __construct()
    {
         // gaestebuch?name=Max&kommentar=Hallo%20Ich.. 
       if(isset($_POST['name'],$_POST['kommentar'])){
          $name = htmlspecialchars(strip_tags($_POST['name']));//XSS Schutz
          $text = htmlspecialchars(strip_tags($_POST['kommentar']));
          // hat ein User ein file geschickt
          if(isset($_FILES['userfile'])) { 
                    $newname = $this->setUpload();
          }                            
          Model::setNewComment($name,$text);
          header('Location: '.$_SERVER['PHP_SELF']);//kompletter Neuaufbau
       }

        $data = Model::getAllComments();
        //var_dump($data);//Test
        new View($data);
    }

    private function setUpload(){
        $name = $_FILES['userfile']['name']; // Name des uploadfile
        $newname = hash('sha1',$name);// aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d.jpg
        $ext = pathinfo($name,PATHINFO_EXTENSION);
        $newname = $newname.'.'.$ext;// Name zum Speichern
        if(@move_uploaded_file($_FILES['userfile']['tmp_name'],INI['UPLOAD'].$newname)){
            return $newname; //bei Erfolg
        }else{
           return NULL;// nicht gespeichert dann NULL in Datenbank
        }
    }
}

?>