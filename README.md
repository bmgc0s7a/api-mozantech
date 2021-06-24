# api-mozantech

API Mozantech

This API is the solution on this problem https://github.com/Mozantech/orders-exercise and have not protect login or
token access, this is simple API.

The contrctrution the API it's based on two 2 text files (Produtos / Encomendas), because  it's easy for test and not it's necessary import / Create BD, just extract files and enjoy! :)


____________________________________________________________________________________________________________________________

How the API Work?

The API contain 4 option to you call  GET, POST, PUT and DELETE and you should use the this example:

//GET 

$url = "http://localhost/API_mozantech/encomendas/"; or $url = "http://localhost/API_mozantech/produtos/"; or $url = "http://localhost/API_mozantech/produtos/1"; //Link where you install de API

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

curl_close($curl);

echo $response . PHP_EOL; //Show the results


Note:

The URL "http://localhost/API_mozantech/produtos/1" or "http://localhost/API_mozantech/encomendas/1" show only product / orders ID 1;


______________________________________________________________________________________________________________

// POST

$url = "http://localhost/API_mozantech/encomendas/"; or $url = "http://localhost/API_mozantech/produtos/";

$data = ["id" => "4", "payment" => "paypal", "price" => "10.20"]; // Order or $data = ["id" => "4", "name" => "Laca Cabelo", "price" => "10.20"]; // Product

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_POST, true);

curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));

$response = curl_exec($curl);

curl_close($curl);

echo $response . PHP_EOL; //Show the results

Note:

The ID the orders or product is mandatory to be sequential, because the search in file text was developed thus.

__________________________________________________________________________________________________________

// PUT

$url = "http://localhost/API_mozantech/produtos/"; or $url = "http://localhost/API_mozantech/encomendas/";

$data = ['id' => '1', "name" =>'teste']; // Product or $data = ['id' => '1', "price" =>'10.70']; // Order

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');

curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));

$response = curl_exec($curl);

curl_close($curl);

echo $response . PHP_EOL;

Note:

The method PUT only show the message product or order was updated, because in file txt not easy update one line.

____________________________________________________________________________________________________________

// DELETE

$url = "http://localhost/API_mozantech/produtos/"; or $url = "http://localhost/API_mozantech/encomendas/";

$data = ['id' => '2'];

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));

$response = curl_exec($curl);

curl_close($curl);

echo $response . PHP_EOL;

Note:

The method DELETE only show the message product or order was updated, because in file txt not easy update one line.

