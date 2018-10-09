<style>


ul{
  font-size: 20px;
  margin:0px
  padding:0px;
  list-style:none;
  margin-top: 20px;
}
ul li {margin-right: 20px;
   display:inline;}
ul li a{color:orange;
     background:#999; margin: 0px; padding: 5px;
     text-decoration: none;
   }
ul li a:hover{background:#222; color:#fff }
</style>


<?php
$array = array("home", "contacts","about");
echo '<ul>';
foreach($array as $key =>$value){
echo '<li><a href="'.$value.'.php">'.$value.'</a></li>';
}
echo '</ul>';
?>
