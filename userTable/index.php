<?php
include "App.php";
include "Data.php";
include "IStorage.php";
include "FileStorage.php";
include "DBStorage.php";

$app = new App();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <style>
        div.addForm {
            width: fit-content;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        div.menu {
            width: fit-content;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;

        }

        div.menu a {
            display: inline-block;
            width: 120px;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            color: black;
            font-family: Arial;
            font-size: 17px;
            font-weight: bold;
            border: 1px solid gray;
        }

        div.menu a:hover {
            background-color: gray;
            color: white;
        }

        .send {
            text-align: center;
        }

        .send input {
            background-color: white;
            border: 1px solid gray;
            padding: 5px 20px 5px 20px;
            font-family: Arial;
            font-size: 17px;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 5px;
        }

        .send input:hover {
            background-color: gray;
            color: white;
        }

        h2 {
            text-align: center;
        }

        .personsTable {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        .personsTable th div{
            padding: 10px;
        }

        .personsTable th a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: black;
        }

        .personsTable td {

            margin: 7px 10px 7px 10px;
            text-align: center;
        }

        .personsTable td a {
            display: block;
            padding: 5px 0px 5px 0px;
            text-decoration: none;
            color: red;
            font-size: 20px;
        }

        div.pages {
            width: fit-content;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
        }

        div.pages a {
            padding: 5px;
            color: black;
            text-decoration: none;
            font-size: 18px;
        }

    </style>

</head>
<body>
<div class="menu">
    <a href="?akcia=form">Pridať osobu</a>
    <a href="?akcia=vypis">Výpis osôb</a>
</div>

<br><br>
<?php
if ($app->zobrazForm()) {
    ?>
    <div class="addForm">
    <form method="post">

        <table>

            <tr>
                <td>
                    <label>
                        Meno
                    </label>
                </td>

                <td>
                    <input type="text" name="meno">
                </td>
            </tr>

            <tr>
                <td>
                    <label>
                        Priezvisko
                    </label>
                </td>

                <td>
                    <input name="priezvisko">
                </td>
            </tr>

            <tr>
                <td>
                    <label>
                        Rok narodenia
                    </label>
                </td>

                <td><input type="number" name="rokNarodenia"></td>
            </tr>

            <tr>
                <td class="send" colspan="2">
                    <input type="submit" name="odoslat" value="Odoslať">
                </td>
            </tr>

        </table>


    </form>
    </div>
    <?php
} else {
    echo "<h2>Osoby</h2>";
    echo "<table class='personsTable' border='1'>";

    if($app->getSort() == "asc")
    {
        $app->setSort("desc");
    } else {
        $app->setSort("asc");
    }

    $linkMeno = "?stlpec=meno&page=".$app->getStr()."&sort=".$app->getSort();
    echo "<th><a href='".$linkMeno."'>Meno</a></th>";

    $linkPriezvisko = "?stlpec=priezvisko&page=".$app->getStr()."&sort=".$app->getSort();
    echo "<th><a href='".$linkPriezvisko."'>Priezvisko</a></th>";

    $linkRok = "?stlpec=rokNarodenia&page=".$app->getStr()."&sort=".$app->getSort();
    echo "<th><a href='".$linkRok."'>Rok narodenia</a></th>";

    $linkVek = "?stlpec=aktualnyVek&page=".$app->getStr()."&sort=".$app->getSort();
    echo "<th><a href='".$linkVek."'>Aktuálny vek</a></th>";

    echo "<th> <div>Odstrániť</div> </th>";


    $index = 0;
    foreach ($app->getData($app->getStr(), $app->getStlpec(), $app->getSort()) as $data) {

        $a = 1;
        //$index < $app->getStr() * 5 && $index > $app->getStr() * 5 - 6
        if($a == 1)
        {
            $link = "?remove=".$data->getId();

            echo "<tr>";
            echo "<td>" . $data->getMeno() . "</td>";
            echo "<td>" . $data->getPriezvisko() . "</td>";
            echo "<td>" . $data->getRokNarodenia() . "</td>";
            echo "<td>" . $data->getAktualnyVek() . "</td>";
            echo "<td><a href='".$link."'>x</a></td>";
            echo "</tr>";
        }
       $index++;
    }
    echo "</table>";

    $pocetStranok = $app->getDataCount() / 5;

    $pocetStranok = ceil($pocetStranok);

    if($pocetStranok == 0)
    {
        $pocetStranok = 1;
    }

    echo "<div class='pages'>";


    $previousPage = 0;
    if($app->getStr() == 1)
    {
        $previousPage = 1;
    } else {
        $previousPage = $app->getStr() - 1;
    }

    $nextPage = 0;
    if($app->getStr() == $pocetStranok)
    {
        $nextPage = $pocetStranok;
    } else {
        $nextPage = $app->getStr() + 1;
    }

    $strLink = "?page=".$previousPage;

    echo"<a href='".$strLink."'><<</a>";

    $index = 0;

    if($pocetStranok == $app->getStr())
    {
        for($i = $pocetStranok - 2; $i <= $pocetStranok; $i++)
        {


                $strLink = "?page=".$i;

                echo"<a href='".$strLink."'>$i</a>";




        }
    } else if($app->getStr() == 1) {
        for($i = 1; $i <= 3; $i++)
        {


                $strLink = "?page=".$i;

                echo"<a href='".$strLink."'>$i</a>";


        }
    } else {
        for($i = $app->getStr()-1; $i <= $app->getStr()+1; $i++)
        {


            $strLink = "?page=".$i;

            echo"<a href='".$strLink."'>$i</a>";


        }
    }



    $strLink = "?page=".$nextPage;

    echo"<a href='".$strLink."'>>></a>";


    echo "</div>";

}
?>
</body>
</html>
