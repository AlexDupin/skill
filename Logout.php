<!doctype html>
<html>
<head>
<?php

setcookie("uname",NULL, time()-3600);
setcookie("username",NULL, time()-3600);
setcookie("name",NULL, time()-3600);
setcookie("pwd",NULL, time()-3600);
setcookie("uid",NULL, time()-3600);
setcookie("acclvl",NULL, time()-3600);
setcookie("NewLogin","FAlSE", time()-3600);

echo "<meta http-equiv='refresh' content='0 url=index.html'>";

?>
</head>
</html>