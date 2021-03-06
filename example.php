<?php
require __DIR__ . '/vendor/autoload.php';

use Vinnia\Untappd\Client;

$env = require __DIR__ . '/env.php';
$client = Client::make($env['client_id'], $env['client_secret']);
$data = [];

if ($_POST) {
    $res = $client->searchBrewery($_POST['searchString']);
    $data = json_decode((string) $res->getBody(), true);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Untappd brewery info</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">


</head>
<body>

    <div class="container">
        <h1>Search Brewery</h1>

        <?php if ($data): ?>
            Info for <strong><?php echo $_POST['searchString']; ?></strong>

            <?php
            //TODO: Nicer presentation
            var_dump($data);
            ?>

            <hr />

        <?php endif; ?>

        <form method="post" action="">
            <input class="form-control"
                   type="text"
                   name="searchString"
                   placeholder="Brewery Name" />

            <br />

            <button class="btn btn-primary">Search for brewery</button>
        </form>
    </div>



</body>
</html>
