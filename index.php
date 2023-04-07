<?php
// include the library
include('simple_html_dom.php');

// create a DOM object and load the HTML content

$text = "2022";
$count = strlen($text) - 1;

$html = new simple_html_dom();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://uztelecom.uz/uz/jismoniy-shaxslarga/mobil-raqamlarni-onlayn-band-qilish?phone_number_1='.($count > 7 ? $text[$count - 8] : "").'&phone_number_2='.($count > 6 ? $text[$count - 7] : "").'&phone_number_3='.($count > 5 ? $text[$count - 6] : "").'&phone_number_4='.($count > 4 ? $text[$count - 5] : "").'&phone_number_5='.($count > 3 ? $text[$count - 4] : "").'&phone_number_6='.($count > 2 ? $text[$count - 3] : "").'&phone_number_7='.($count > 1 ? $text[$count - 2] : "").'&phone_number_8='.($count > 0 ? $text[$count - 1] : "").'&phone_number_9='.$text[$count]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html->load(curl_exec($ch));
curl_close($ch);
$mobile_numbers = $html->find('#mobileNumbersList div');


// extract the text from each h2 and p tag and print it
echo "<pre>";
foreach ($mobile_numbers as $number) {
    $phone_number = $number->find('h2', 0)->plaintext;
	$phone_number = str_replace(' ', '', $phone_number);
    $price = str_replace(' so‘m', '', $number->find('p', 0)->plaintext);
	$price = str_replace(' ', '', $price);
    echo $phone_number . ' ' . $price . "\n";
}
echo "</pre>";
// clean up the DOM object
$html->clear();
unset($html);

?>