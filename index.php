<?php

setlocale(LC_TIME, "fr_FR");

$monthsArray = [
    1 => 'Janvier',
    2 => 'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 => 'Août',
    9 => 'Septembre',
    10 => 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre'
];

$daysArray = [
    1 => 'Lundi',
    2 => 'Mardi',
    3 => 'Mercredi',
    4 => 'Jeudi',
    5 => 'Vendredi',
    6 => 'Samedi',
    7 => 'Dimanche'
];

$startIntYears = 2015;
$endIntYears = 2025;

if(isset($_GET["afficher"])){
    $months = $_GET["selectedMonth"];
    $years = $_GET["selectedYear"];

    $numbersDays = cal_days_in_month(CAL_GREGORIAN, $months, $years);
    $firstDay = strftime("%u", mktime(0, 0, 0, $months, 1, $years));
    $totalCases = $numbersDays + $firstDay - 1;

    if(($totalCases % 7 != 0)){
        $caseSupp = 7 - ($totalCases % 7);
    } else {
        $caseSupp = 0;
    }

} else {
    $numbersDays = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
    $firstDay = strftime("%u", time());
    $totalCases = $nbrDaysinaMonth + $firstDayOfMonth - 1;
    if(($totalCases % 7 != 0)){
        $caseSupp = 7 - ($totalCases % 7);
    } else {
        $caseSupp = 0;
    }
}


?>
<!doctype html>
<html lang="fr">

<head>
    <title>TP_Calendar_PHP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <p class="titleCalendar">Calendrier 2015 - 2025</p>
    
    <form action="index.php" method="GET">
    <div id="calendar">

        <select class="form-select" name="selectedMonth">
            <option selected>Sélectionner votre mois</option>
                <?php
                    foreach($monthsArray as $key => $value){?>
                    <option value="<?= $key ?>" <?= isset($_GET['selectedMonth']) && $_GET['selectedMonth'] == $key ? 'selected' : '' ?>><?= $value ?></option>
                <?php } ?>
        </select>

        <select class="form-select" name="selectedYear">
            <option selected>Sélectionner votre année</option>
                <?php 
                    for($startIntYears; $startIntYears <= $endIntYears; $startIntYears++){?>
                    <option value="<?= $startIntYears ?>" <?= isset($_GET['selectedYear']) && $_GET['selectedYear'] == $startIntYears ? 'selected' : '' ?>><?= $startIntYears ?></option>
                <?php } ?>
        </select>

            <input type="submit" name="afficher">
            <input type="button" value="Retour" class="buttonRetour">
        </div>

    </form>

<div class="row justify-content-center">

<table class="table col-12 col-sm-8 col-md-4">
    <thead>
        <tr>
            <?php
            foreach($daysArray as $key => $value){?>
            <th value="<?= $key ?>"><?= $value ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
            $day = 1;
            for ($case = 1; $case <= ($totalCases + $caseSupp); $case++) { ?>
            <td class="<?= $case >= $firstDay && $day <= $numbersDays ? "" : "bg-light" ?>"><?= $case >= $firstDay && $day <= $numbersDays ? $day++ : '' ?></td>
            <?php 
            // toutes les 7 cases on insert un tr
            if ($case % 7 == 0) { ?> 
            </tr>
            <tr>
            <?php
            }
            } ?>
            </tr>
  </tbody>
</table>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>