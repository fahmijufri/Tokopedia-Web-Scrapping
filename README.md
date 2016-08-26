# Tokopedia-Web-Scrapping
Tokopedia Website Scrapping using cURL
<br/><br/>
Thanks to [Ican Bachors](https://github.com/bachors)
untuk inspirasi dan code-nya


<h2>USAGE</h2>
```
<?php
// require file tokopedia.php
require('lib/tokopedia.php');

// call Tokopedia class 
$tokopedia = new Tokopedia();

// call method showProduct('YOUR-URL-NAME');
$result = $tokopedia->showProduct('VaporTA');

// echo data to JSON_PRETTY_PRINT (optional)
$r = json_decode($result);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($r, JSON_PRETTY_PRINT);

?>
```
