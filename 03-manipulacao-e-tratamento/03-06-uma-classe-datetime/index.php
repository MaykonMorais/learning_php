<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.06 - Uma classe DateTime");

/*
 * [ DateTime ] http://php.net/manual/en/class.datetime.php
 */
fullStackPHPClassSession("A classe DateTime", __LINE__);
define("DATE_BR", "d/m/Y h:i:s");

$dateNow = new DateTime();
$dateBirth = new DateTime("1996-08-01");
$dateStatic = DateTime::createFromFormat(DATE_BR, "10/03/2020 12:00:00");

var_dump(
    $dateNow,
    $dateBirth,
    $dateStatic
);

var_dump(
    [
        $dateNow->format(DATE_BR),
        $dateNow->format("d")
    ]);

echo "<p>Hoje é dia {$dateNow->format("d")} do {$dateNow->format("m")} de {$dateNow->format("y")}</p>";

// definindo timezones
$newDateTimeZone = new DateTimeZone("Pacific/Apia"); // manipular TimeZone
$newDateTime = new DateTime("now", $newDateTimeZone);

var_dump(
    [
        $newDateTimeZone,
        $newDateTime,
        $dateNow
    ]
);
/*
 * [ DateInterval ] http://php.net/manual/en/class.dateinterval.php
 * [ interval_spec ] http://php.net/manual/en/dateinterval.construct.php
 */
fullStackPHPClassSession("A classe DateInterval", __LINE__);

$dateInterval = new DateInterval("P10Y2MT10M");

//var_dump($dateInterval);

$dateTime = new DateTime();
$dateTime->add($dateInterval);
$dateTime->sub($dateInterval);

//var_dump($dateTime);

echo "<h3></h3>";

$birth = new DateTime(date("Y")."-08-05");
var_dump($birth);

echo "<h3></h3>";

$dateNow = new DateTime("now");
$diff = $dateNow->diff($birth); // birth - dateNow
var_dump($diff);

if($diff->invert)  {
    echo "<p>Seu aniversário foi há {$diff->days}</p>";
} else {
    echo "<p>Faltam {$diff->days} dias para seu aniversário</p>";
}

echo "<h3></h3>";

$dateResources = new DateTime("now");

var_dump(
    [
        $dateResources->format(DATE_BR),
        $dateResources->sub(DateInterval::createFromDateString("10days"))->format(DATE_BR),
        $dateResources->add(DateInterval::createFromDateString("10days"))->format(DATE_BR)
    ]
);



/**
 * [ DatePeriod ] http://php.net/manual/pt_BR/class.dateperiod.php
 * Criar um período de datas entre uma e outra (pulos de datas)
 */
fullStackPHPClassSession("A classe DatePeriod", __LINE__);

$start = new DateTime("now");
$interval = new DateInterval("P1M");
$end  =  new DateTime("2021-06-01");

$period = new DatePeriod($start, $interval, $end);

var_dump(
    [
        $start->format(DATE_BR),
        $interval,
        $end->format(DATE_BR)
    ],
    $period
);

echo "<h1>Sua assinatura: </h1>";

foreach ($period as $recurrences)  {
    echo "<p>Próximo vencimento {$recurrences->format(DATE_BR)}</p>";
}