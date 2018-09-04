// Phone book from JSON

<?php
    $string = file_get_contents(__DIR__ . "/contacts.json");
    $data = json_decode($string, true);
?>

<html>
  <head>
    <title>Phone book</title>
  </head>

  <body>
    <table>
      <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Address</td>
        <td>Phone Number</td>
      </tr>
      <?php foreach($data as $person) { ?>
      <tr>
        <td><?php echo $person['firstName'] ?></td>
        <td><?php echo $person['lastName'] ?></td>
        <td><?php echo $person['address'] ?></td>
        <td><?php echo $person['phoneNumber'] ?></td>
      </tr>
      <?php } ?>
    </table>
  </body>
</html>
