Copy the following code and paste it into your site's <body> section, where you want the search box and the search results to render.

<script async src="https://cse.google.com/cse.js?cx=74ef92dbf72f04cfd">
</script>
<div class="gcse-search"></div>


<?php
// Set your API key
$apiKey = 'AIzaSyBL4c8q63-Tuq0f5JWgXVRZEkD0iIRX9H4';

// Set the search engine ID
$searchEngineId = '74ef92dbf72f04cfd';

// Set the search query
$query = 'shoes';

// Build the URL
$url = 'https://www.googleapis.com/customsearch/v1?key=' . $apiKey . '&cx=' . $searchEngineId . '&q=' . urlencode($query);

// Make the request
$response = file_get_contents($url);

// Decode the JSON response
$results = json_decode($response);

// Display the results
foreach ($results->items as $item) {
    echo $item->title . "<br>";
    echo $item->link . "<br>";
    echo $item->snippet . "<br><br>";
}
?>



