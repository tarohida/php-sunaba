#!/usr/bin/php
<?php
// https://qiita.com/suin/items/8eb3bef87e346a4747c6
// 2GiB のファイルを作成
$file_name = 'dummy-file';
$filesize = 2147483648;
$fp = fopen($file_name, 'wb');
ftruncate($fp, $filesize);
fclose($fp);

$memory_usage_real_start = memory_get_usage(true);
$memory_usage_start = memory_get_usage();
$memory_usage_peak_real_start = memory_get_peak_usage(true);
$memory_usage_peak_start = memory_get_peak_usage();

$variable = file_get_contents($file_name);

$memory_usage_real_end = memory_get_usage(true);
$memory_usage_end = memory_get_usage();
$memory_usage_peak_real_end = memory_get_peak_usage(true);
$memory_usage_peak_end = memory_get_peak_usage();

$memory_usage_real = formatSizeUnits($memory_usage_real_end - $memory_usage_real_start);
$memory_usage = formatSizeUnits($memory_usage_end - $memory_usage_start);
$memory_usage_peak_real = formatSizeUnits($memory_usage_peak_real_end - $memory_usage_peak_real_start);
$memory_usage_peak = formatSizeUnits($memory_usage_peak_end - $memory_usage_peak_start);

$memory_limit = ini_get('memory_limit');
echo <<<EOL
Memory Limit: $memory_limit
Memory Usage: 
    Start: $memory_usage_start
    End: $memory_usage_end
    Diff: $memory_usage
Memory Usage (real):
    Start: $memory_usage_real_start
    End: $memory_usage_real_end
    Diff: $memory_usage_real
Memory Peak Usage: 
    Start: $memory_usage_peak_start
    End: $memory_usage_peak_end
    Diff: $memory_usage_peak
Memory Peak Usage (real): 
    Start: $memory_usage_peak_real_start
    End: $memory_usage_peak_real_end
    Diff: $memory_usage_peak_real


EOL;



/**
 * @link https://stackoverflow.com/questions/60913735/is-there-anyway-to-get-the-average-of-filesizes-php
 */
function formatSizeUnits($bytes): string
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}
