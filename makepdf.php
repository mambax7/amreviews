<?php

/**
 * File : makefile.pdf for publisher
 * For tcpdf_for_xoops 2.01 and higher
 * Created by montuy337513 / philodenelle - http://www.chg-web.org
 **/
error_reporting(0);

include_once __DIR__ . '/header.php';
$itemid       = XoopsRequest::getInt('itemid', 0, 'GET');
$item_page_id = XoopsRequest::getInt('page', -1, 'GET');
if ($itemid === 0) {
    redirect_header('javascript:history.go(-1)', 1, _MD_PUBLISHER_NOITEMSELECTED);

}
if (!is_file(XOOPS_PATH . '/vendor/tcpdf/tcpdf.php')) {
    redirect_header(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/review.php?id=' . $itemid, 3, 'TCPF for Xoops not installed in ./xoops_lib/vendor/');
}
// Creating the item object for the selected item
$itemObj = $publisher->getHandler('item')->get($itemid);

// if the selected item was not found, exit
if (!$itemObj) {
    redirect_header('javascript:history.go(-1)', 1, _MD_PUBLISHER_NOITEMSELECTED);
}

// Creating the category object that holds the selected item
$categoryObj = $publisher->getHandler('category')->get($itemObj->categoryid());

// Check user permissions to access that category of the selected item
if (!$itemObj->accessGranted()) {
    redirect_header('javascript:history.go(-1)', 1, _NOPERM);
}

xoops_loadLanguage('main', PUBLISHER_DIRNAME);

$dateformat    = $itemObj->datesub();
$sender_inform = sprintf(_MD_PUBLISHER_WHO_WHEN, $itemObj->posterName(), $itemObj->datesub());
$mainImage     = $itemObj->getMainImage();

$content = '';
if ($mainImage['image_path'] !== '') {
    $content .= '<img src="' . $mainImage['image_path'] . '" alt="' . $myts->undoHtmlSpecialChars($mainImage['image_name']) . '"/>';
}
$content .= '<a href="' . PUBLISHER_URL . '/item.php?itemid=' . $itemid . '" style="text-decoration: none; color: black; font-size: 120%;" title="' . $myts->undoHtmlSpecialChars($itemObj->title()) . '">' . $myts->undoHtmlSpecialChars($itemObj->title()) . '</a>';
$content .= '<br /><span style="color: #CCCCCC; font-weight: bold; font-size: 80%;">' . _CO_PUBLISHER_CATEGORY . ' : </span><a href="' . PUBLISHER_URL . '/category.php?categoryid=' . $itemObj->categoryid() . '" style="color: #CCCCCC; font-weight: bold; font-size: 80%;" title="' . $myts->undoHtmlSpecialChars($categoryObj->name()) . '">' . $myts->undoHtmlSpecialChars($categoryObj->name()) . '</a>';
$content .= '<br /><span style="font-size: 80%; font-style: italic;">' . $sender_inform . '</span><br />';
$content .= $itemObj->plain_maintext();

// Configuration for TCPDF_for_XOOPS
$pdf_data = array(
    'author'           => $itemObj->posterName(),
    'title'            => $myts->undoHtmlSpecialChars($categoryObj->name()),
    'page_format'      => 'A4',
    'page_orientation' => 'P',
    'unit'             => 'mm',
    'rtl'              => false //true if right to left
);
require_once(XOOPS_PATH . '/vendor/tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, _CHARSET, false);

$doc_title    = publisher_convertCharset($myts->undoHtmlSpecialChars($itemObj->title()));
$doc_keywords = 'XOOPS';
$docKeywords  = $myts->undoHtmlSpecialChars($itemObj->meta_keywords());
if (array_key_exists('rtl', $pdf_data)) {
    $pdf->setRTL($pdf_data['rtl']);
};
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor(PDF_AUTHOR);
$pdf->SetTitle($doc_title);
$pdf->SetSubject($docSubject);
//$pdf->SetKeywords(XOOPS_URL . ', '.' by TCPDF_for_XOOPS (chg-web.org), '.$doc_title);
$pdf->SetKeywords($docKeywords);

$firstLine  = publisherConvertCharset($GLOBALS['xoopsConfig']['sitename']) . ' (' . XOOPS_URL . ')';
$secondLine = publisherConvertCharset($GLOBALS['xoopsConfig']['slogan']);

//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $firstLine, $secondLine);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $firstLine, $secondLine, array(0, 64, 255), array(0, 64, 128));

//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor

$pdf->setHeaderFont(array(PDF_FONT_NAME_SUB, '', PDF_FONT_SIZE_SUB));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

//initialize document
$pdf->Open();
$pdf->AddPage();
$pdf->writeHTML($content, true, 0, true, 0);
$pdf->Output();
