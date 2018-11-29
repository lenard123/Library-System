<?php 

require_once __DIR__."/Config.php";

/**
 * Return the file with the base url
 * @param string $file
 * @return string $baseurl+$file;
 */
function _public ($file = "")
{
    global $config;
    return $config['baseurl'].$file;
}





/**
 * Add a default value if the original is null
 * @param $original
 * @param $default THE DEFAULT VALUE
 * @return ($original || $default)
 */
function optional ($original, $default)
{
    return $original ? $original : $default;
}





function getDays ($from, $to = false, $absolute = false)
{
    if ($to === FALSE) $to = date("Y-m-d");

    $from = date_create($from);
    $to = date_create($to);

    $diff = date_diff($from, $to);

    switch ($diff->days) {
        case 0:
            return "Today";
            break;
        
        case 1:
            return "Yesterday";
            break;

        default:
            return $diff->days." days ago";
            break;
    }
}




/**
 * Redirect to the given page
 * @param string $page
 * @return header
 */
function redirect ($page)
{
    return header("Location: "._public("pages/$page"));
}
