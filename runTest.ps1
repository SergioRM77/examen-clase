Param(
    [string] $ScriptTest
)
$date=$(Get-Date).ToString("yyyyMMddhhmmss")
$OutputFileName=$date+"_ReportSuite.html"
./vendor/bin/phpunit ./tests/$ScriptTest.php --testdox-html ./logs/tests/$OutputFileName --coverage-html ./logs/coverage