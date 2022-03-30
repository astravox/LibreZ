<?php
    function wikipedia_results($query, $response) 
    {
        $query_encoded = urlencode($query);

        $json_response = json_decode($response, true);

        $first_page = array_values($json_response["query"]["pages"])[0];

        if (!array_key_exists("missing", $first_page))
        {
            $description = substr($first_page["extract"], 0, 250) . "...";

            $source = "https://en.wikipedia.org/wiki/$query";
            $response = array(
                "special_response" => array(
                    "response" => $description,
                    "source" => $source
                )
            );

            if (array_key_exists("thumbnail",  $first_page))
                 $response["special_response"]["image"] = $first_page["thumbnail"]["source"];

            return $response;
        }
    }
?>