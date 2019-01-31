<html>
 <head>
     <title>VAII exercise</title>

     <?php
     require 'randomEntity.php';
     ?>

     <style>

         body {
             background-color: wheat;
         }

         h3 {
             text-align: center;
         }

         table {
             border: 3px solid darkred;
             border-collapse: separate;
             margin-right: auto;
             margin-left: auto;
             border-radius: 10px;
         }

         table th {
            border-right: 1px solid white;
             border-bottom: 1px solid white;
             background-color: darkred;
             color: white;
             width: 150px;
             height: 30px;
         }

         table th a {
             display: block;
             color: white;
             text-decoration: none;
             width: 100%;
             height: 100%;
             padding-top: 4px;
         }

         table td {
            border-right: 1px solid white;
             border-bottom: 1px solid white;
             background-color: black;
             text-align: center;
             color: white;
         }

         p {
             text-align: center;
            padding-bottom: 20px;
         }

         table td:hover {
             color: black;
             background-color: white;
         }

     </style>

 </head>
 <body>


 <br>
 <h3>Exercise 3</h3>
 <br>

<?php

$randomField = array();

for($index = 0; $index < 10; $index++)
{
    $randomField[$index] = new randomValues();
}


$sortDirection = "up";
$column = "none";

function sortAccNumberUpwardly($first, $second)
{
    if ($first->getNumberValue() == $second->getNumberValue()) return 0;
    return ($first->getNumberValue() < $second->getNumberValue()) ? -1 : 1;
}

function sortAccNumberDownwardly($first, $second)
{
    if ($first->getNumberValue() == $second->getNumberValue()) return 0;
    return ($first->getNumberValue() > $second->getNumberValue()) ? -1 : 1;
}


function sortAccStringUpwardly($first, $second)
{
    if ($first->getStringValue() == $second->getStringValue()) return 0;
    return ($first->getStringValue() < $second->getStringValue()) ? -1 : 1;
}

function sortAccStringDownwardly($first, $second)
{
    if ($first->getStringValue() == $second->getStringValue()) return 0;
    return ($first->getStringValue() > $second->getStringValue()) ? -1 : 1;
}

if(isset($_GET['sortDirection']) && isset($_GET['column']) && isset($_GET['change']))
{
    $sortDirection = $_GET['sortDirection'];
    $column = $_GET['column'];

    if($column == "num")
    {
        if($_GET['change'] == "true")
        {

            echo "<p>Sorted acc. number upwardly change</p>";
            $sortDirection = "down";
            usort($randomField,"sortAccNumberUpwardly");


        } else {
            if($sortDirection == "up")
            {
                echo "<p>Sorted acc. number upwardly no change</p>";
                $sortDirection = "down";
                usort($randomField,"sortAccNumberUpwardly");
            } else {
                echo "<p>Sorted acc. number downwardly no change</p>";
                $sortDirection = "up";
                usort($randomField,"sortAccNumberDownwardly");
            }
        }

    } else {

        if($_GET['change'] == "true") {

            echo "<p>Sorted acc. string upwardly change</p>";
            $sortDirection = "down";
            usort($randomField,"sortAccStringUpwardly");

        } else {
            if ($sortDirection == "up") {
                echo "<p>Sorted acc. string upwardly no change</p>";
                $sortDirection = "down";
                usort($randomField,"sortAccStringUpwardly");
            } else {
                echo "<p>Sorted acc. string downwardly no change</p>";
                $sortDirection = "up";
                usort($randomField,"sortAccStringDownwardly");
            }
        }

    }

}

?>

 <table>

<tr>
    <th><a href="mainLayout.php?sortDirection=<?php if($sortDirection == "up") echo "up"; if($sortDirection == "down") echo "down";?>&column=num&change=<?php if($column == "str") echo "true"; if($column == "none") echo "true"; if($column == "num") echo "false";?>">Random number</a></th>
    <th><a href="mainLayout.php?sortDirection=<?php if($sortDirection == "up") echo "up"; if($sortDirection == "down") echo "down";?>&column=str&change=<?php if($column == "num") echo "true"; if($column == "none") echo "true"; if($column == "str") echo "false";?>">Random string</a></th>
</tr>

 <?php

for($index = 0; $index < 10; $index++)
{
    echo "<tr> 
            
          <td>".$randomField[$index]->getNumberValue()."</td>
          <td>".$randomField[$index]->getStringValue()."</td>
          </tr>";
}

?>

 </table>




 </body>
</html>