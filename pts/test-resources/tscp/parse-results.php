<?php
$log_file = file_get_contents(getenv("LOG_FILE"));
$BENCHMARK_RESULTS = substr($log_file, strrpos($log_file, "Nodes per second:") + 18);
echo trim(substr($BENCHMARK_RESULTS, 0, strpos($BENCHMARK_RESULTS, " (")));
?>