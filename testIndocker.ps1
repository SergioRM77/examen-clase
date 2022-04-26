Param(
    [string] $Contenedor,
    [string] $ScriptTest,
    [string] $TestNames
)
$date=$(Get-Date).ToString("yyyyMMddhhmmss")
$OutputFileName=$date+"-"+$TestNames
./vendor/bin/phpunit ./tests/$ScriptTest.php --filter $TestNames --testdox-html ./logs/tests/$OutputFileName.html