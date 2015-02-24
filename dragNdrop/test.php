<?php
	// get the HTML

	$dom = new DOMDocument();

	$dom->loadHTML("index.html");

	$xpath = new DOMXPath($dom);
	$divContent = $xpath->query('//div[id="canvas"]');
	var_dump($divContent->item(1));
    ob_start();
    include('index.html');
    $content = ob_get_clean();
    var_dump($content);

    // convert in PDF
    require_once('lib/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->writeHTML($divContent, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple01.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
