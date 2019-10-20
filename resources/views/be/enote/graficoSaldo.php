<?php 

// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.

$string = file_get_contents({
  "cols": [
        {"dia":"","label":"Dia","type":"string"},
        {"Saldo":"","label":"SaldoPunta","type":"number"}
        {"Promedio":"","label":"SaldoProm","type":"number"}
      ],
  "rows": [
        {"c":[{"v":"20/04/2018","f":null},{"v":500,"f":null},{"v":400,"f":null}
    		 ]
    	},
        {"c":[{"v":"21/04/2018","f":null},{"v":550,"f":null},{"v":420,"f":null}]},
        {"c":[{"v":"22/04/2018","f":null},{"v":600,"f":null},{"v":440,"f":null}]},
        {"c":[{"v":"23/04/2018","f":null},{"v":650,"f":null},{"v":460,"f":null}]},
        {"c":[{"v":"25/04/2018","f":null},{"v":700,"f":null},{"v":480,"f":null}]}
      ]
});
echo $string;

// Instead you can query your database and parse into JSON etc etc

?>