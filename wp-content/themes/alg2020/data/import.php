<?php
require(__DIR__ . "/../../../../wp-load.php");

$file = __DIR__ . "/importable_data.csv";
$handle = fopen($file, "r");
$kandis = array();
while (($line = fgetcsv($handle, 0, ";")) !== FALSE) {
    $kandis[] = $line;
}
fclose($handle);

$bisherige = ["Ivo Egger", "Andreas Lustenberger", "Esther Haas", "Luzian Franzini", "Stephanie Vuichard", "Tabea Zimmermann-Gibson", "Hanni Schriber-Neiger", "Andreas Hürlimann", "Anastas Odermatt", "Rita Hofer", "Stefan Hodel", "Dagmar Amrein", "Michele Willimann", "Tabea Zimmermann-Gibson", "Patrick Steinle", "Christoph Zumbühl"];

foreach ($kandis as $kandi) :
    $postdate = date("Y-m-d H:i:s");
    $new_post = array(
        'post_title'    =>   $kandi[0] . " " . $kandi[1],
        'post_date'     =>   $postdate,
        'post_type'     =>   'kandi',
        'post_content'  =>   $kandi[6],
        'post_status'   =>   'publish',
    );
    // create post in wordpress. Yay!
    $new_post_id = wp_insert_post($new_post);


    $bisher = "";
    if ($kandi[13] == 1) {
        $bisher = "bisher";
    }

    update_field('bisher', $bisher, $new_post_id);
    update_field('listenplatz', $kandi[4], $new_post_id);
    $berusfbezeichnung = "";
    $i = 0;
    foreach (explode(";", $kandi[7]) as $bezeichnung) {
        if ($i == 0) {
            $berusfbezeichnung = $bezeichnung;
        } else if ($i <= 2) {
            $berusfbezeichnung .= ", " . $bezeichnung;
        }
        $i++;
    }
    update_field('berufsbezeichnung', $berusfbezeichnung, $new_post_id);
    $byline = "";
    if ($kandi[8] != "") { $byline = $kandi[8]; }
    if ($kandi[10] != "") {
        $i = 0;
        $aemter = "";
        foreach (explode(";", $kandi[10]) as $amt) {
            if ($i == 0) {
                $aemter = $amt;
            } else if ($i <= 2) {
                $aemter .= ", " . $amt;
            }
            $i++;
        }

        if ($byline != "") {
            $byline .= " | " . $aemter;
        } else {
            $byline = $aemter;
        }
    }
    if ($kandi[11] != "") {
        $i = 0;
        $vereine = "";
        foreach (explode(";", $kandi[11]) as $verein) {
            if ($i == 0) {
                $vereine = $verein;
            } else if ($i <= 2) {
                $vereine .= ", " . $verein;
            }
            $i++;
        }

        if ($byline != "") {
            $byline .= " | " . $vereine;
        } else {
            $byline = $vereine;
        }
    }
    update_field('byline', $byline, $new_post_id);

    if ($kandi[3] == "KR") {
        wp_set_object_terms($new_post_id, 'Kantonsrat', 'gremium');
    } else {
        wp_set_object_terms($new_post_id, 'Gemeinderat', 'gremium');
    }

    wp_set_object_terms($new_post_id, $kandi[2], 'gemeinde');


    $some = explode("; ", $kandi[9]);
    $prep = [
        "facebook" => "",
        "twitter" => "",
        "instagram" => "",
        "linkedin" => ""
    ];
    foreach ($some as $link) {
        if (str_starts_with($link, "https://www.facebook.com/")) {
            $prep["facebook"] = $link;
        } else if (str_starts_with($link, "https://twitter.com/")) {
            $prep["twitter"] = $link;
        } else if (str_starts_with($link, "https://www.instagram.com/")) {
            $prep["instagram"] = $link;
        } else if (str_starts_with($link, "https://www.linkedin.com/")) {
            $prep["linkedin"] = $link;
        }
        update_field('somelinks', $prep, $new_post_id);
    }

endforeach;