$date=$(Get-Date).ToString("yyyyMMddhhmmss")
$OutputFileName=$date+"_ReportSuite.html"
./vendor/bin/phpunit --testdox-html ./logs/tests/$OutputFileName --coverage-html ./logs/coverage