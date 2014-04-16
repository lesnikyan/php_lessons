<?php

// XSLT 

// http://anton-pribora.ru/articles/xml/xslt-first-step/
// http://citforum.ru/internet/xmlxslt/xmlxslt.shtml
// http://ua1.php.net/manual/ru/xsltprocessor.transformtoxml.php
// http://ru.wikipedia.org/wiki/XPath

// XML data
$xml = new DOMDocument('1.0', 'utf-8');
$xml->load('page_data.xml');

// XSL template
$xsl = new DOMDocument('1.0', 'utf-8');
$xsl->load('page.xsl');

// XSLT processor
$xslt = new XSLTProcessor();

$xslt->importStylesheet($xsl);
$html = $xslt->transformToXml($xml);

print $html;