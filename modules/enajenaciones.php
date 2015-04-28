<?php
if(!isset($_SESSION["user"])  ){
	require("soporte_error.php");
}else{
	
?>

        
            
              <tr>
              <center> <br><br>
                  
                  <iframe frameborder="0" width="980" height="800" src="soporte/login.php" >
                  
                  </iframe>
              </center>
              </tr>
              <tr>
                <th scope="col">&nbsp;</th>
                <th align="center" valign="top" scope="col">&nbsp;</th>
              </tr>


<?php
}
?>





