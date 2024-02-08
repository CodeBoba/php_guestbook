<?php
class View{
    public function __construct($data = '' ){
        echo $this->getTemplateComments($data);
        echo $this->getTemplateInput();
    }
    private function getTemplateInput(){
        $tpl = '<details>
                 <summary>Kommentieren</summary>
                  <form method="POST" enctype = "multipart/form-data">
                   <input type="text" name="name" placeholder="Ihr Name" required ><br>
                   <textarea name="kommentar" placeholder="Ihr Kommentar" required >
                   </textarea><br>
                   <input type="file" name="userfile" ><br> 
                   <button>senden</button>
                  </form>
                 </details>';
        return $tpl;         
    }
    


    private function getTemplateComments($data){
        $tpl = '';
        foreach($data as $spalte){
        $tpl .= '<div class="comments">';
        $tpl .= '<div class="name">'.$spalte['name'].'</div>';
        //                                  Format      zu unix Zeitstempel umwandeln
        $tpl .= '<div class="datum">'.date('d.m.y H:i',strtotime($spalte['datum'])).'</div>';
        $tpl .= '<div class="text">'.$spalte['text'].'</div>';
        $tpl .= '</div>';
        }
        return $tpl;
    }
}