<?php
// function to return the currency formatted with a thousands separator
// formatCurrency(1000000) == 1,000,000
function formatCurrency($number)
{
    $result = '';
    $number = (string) $number;
    $len = strlen($number);
    for ($i = $len - 1; $i >= 0; $i--) {
        $result = $number[$i] . $result;
        if (($len - $i) % 3 == 0 && $i != 0) {
            $result = ',' . $result;
        }
    }
    return $result;
}

// function to remove the comma
function removeSeparator($number)
{
    return (int) str_replace(',', '', $number);
}

// function to return the current month
function getCurrentMonth()
{
    return date('F'); // F stands for full month name (e.g. January, February, etc.)
}

// function to get the current date in the format dd-mmm-yyyy:
function getCurrentDate()
{
    return date('d-M-Y'); // d stands for day, M for month abbreviation (e.g. Jan, Feb, etc.), and Y for year in four digits
}

// function to return the current time 
function getCurrentTime()
{
    // Set the default time zone to Kampala, Uganda
    date_default_timezone_set('Africa/Kampala');
    // return date('H:i:s'); // H for hour, i for minutes, s for seconds
    // Return the current time in h:i:s A format (12-hour format with AM/PM)
    return date('h:i:s A');
}

// function to return the current year 
function getCurrentYear()
{
    return date('Y');
}
