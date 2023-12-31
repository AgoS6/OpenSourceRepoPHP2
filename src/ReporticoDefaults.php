<?php
/*
 * Global reportico customization ..
 * Set styles :-
 * Styles can be applied to the report body, details page, group headers, trailers,
 * cell styles and are specified as a series of CSS like parameters.
 * Styles are applied to HTML and PDF formats
 *
 * Add page headers, footers with styles to apply to every report page
 *
 */
function reporticoDefaults($reportico)
{
    // Set up styles
    // Use
    // $styles = array ( "styleproperty" => "value", .... );
    // $reportico->applyStyleset("REPORTSECTION", $styles, "columnname", WHENTOAPPLY );
    // Where REPORTSECTION is one of ALLCELLS ROW CELL PAGE BODY COLUMNHEADERS GROUPHEADER GROUPHEADERLABEL GROUPHEADERVALUE GROUPTRAILER
    // and WHENTOAPPLY can be PDF or HTML of leave unsepcified/false for both

    // Don't apply  apply body styles to pdf docuement when using fpdf engine
    if ($reportico->pdf_engine != "fpdf") {

        // REPORT BODY STYLES
        $styles = array(
            //"background-color" => "#cccccc",
            "border-width" => "1px 1px 1px 1px",
            "border-style" => "none",
            "border-color" => "#333333",
            "font-size" => "8pt",
            "font-family" => "freesans",
        );
        $reportico->applyStyleset("BODY", $styles, false, "PDF");
        $reportico->applyStyleset("BODY", $styles, false, "HTML2PDF");

        // CRITERIA BOX STYLES
        $styles = array(
            "background-color" => "#eeeeee",
            "border-style" => "solid",
            "border-width" => "1px 1px 1px 1px",
            "border-color" => "#888888",
            "margin" => "0px 5px 10px 5px",
            "padding" => "0px 5px 0px 5px",
        );
        $reportico->applyStyleset("CRITERIA", $styles, false, "HTML");

        // Hide crtieria box on PDF output
        $styles = array(
            "display" => "none",
        );
        $reportico->applyStyleset("CRITERIA", $styles, false, "PDF");
        $reportico->applyStyleset("CRITERIA", $styles, false, "HTML2PDF");
    }

    // PAGE DETAIL BOX STYLES
    $styles = array(
        "margin" => "0 2 0 2",
        "font-size" => "8pt",
    );
    $reportico->applyStyleset("PAGE", $styles, false, "PDF");
    $reportico->applyStyleset("PAGE", $styles, false, "HTML2PDF");

    // DETAIL ROW BOX STYLES WITH ALTERNATING COLOURS
    // Default all row lines to light grey
    $styles = array(
        "background-color" => "#fdfdfd",
        "margin" => "0 5 0 5",
    );
    $reportico->applyStyleset("ROW", $styles, false, "PDF");
    $reportico->applyStyleset("ROW", $styles, false, "HTML2PDF");

    // Darker grey on every other line
    $styles = array(
        "padding" => "0px 5px 0px 5px",
    );
    $reportico->applyStyleset("ALLCELLS", $styles, false, "PDF");
    $reportico->applyStyleset("ALLCELLS", $styles, false, "HTML2PDF");

    // Darker grey on every other line
    $styles = array(
        "background-color" => "#f0f0f0",
    );
    $reportico->applyStyleset("ALLCELLS", $styles, false, "PDF", "lineno() % 2 == 0");
    $reportico->applyStyleset("ALLCELLS", $styles, false, "HTML2PDF", "lineno() % 2 == 0");

    //GROUP HEADER LABEL STYLES
    $styles = array(
        "margin" => "0 0 0 5",
        "width" => "3cm",
        "requires-before" => "8cm",
        "font-size" => "8pt",
    );
    $reportico->applyStyleset("GROUPHEADERLABEL", $styles, false, "PDF");
    $reportico->applyStyleset("GROUPHEADERLABEL", $styles, false, "HTML2PDF");

    // GROUP HEADER VALUE STYLES
    $styles = array(
        "margin" => "0 20 0 0",
        "font-size" => "8pt",
    );
    $reportico->applyStyleset("GROUPHEADERVALUE", $styles, false, "PDF");
    $reportico->applyStyleset("GROUPHEADERVALUE", $styles, false, "HTML2PDF");

    // ALL CELL STYLES
    /*
    $styles = array(
    "font-family" => "times",
    "border-width" => "1px 1px 1px 1px",
    "border-style" => "solid",
    "border-color" => "#888888",
    );
    $reportico->applyStyleset("ALLCELLS", $styles, false, "PDF");
    $reportico->applyStyleset("ALLCELLS", $styles, false, "HTML2PDF");
     */

    // Specific named cell styles
    /*
    $styles = array(
    "color" => "#880000",
    "font-weight" => "bold",
    "font-style" => "italic",
    );
    $reportico->applyStyleset("CELL", $styles, "id", "PDF");
    $reportico->applyStyleset("CELL", $styles, "id", "HTML2PDF");
     */

    // Column header styles
    $styles = array(
        "color" => "#ffffff",
        "background-color" => "#999999",
        "font-weight" => "bold",
    );
    $reportico->applyStyleset("COLUMNHEADERS", $styles, false, "PDF");
    $reportico->applyStyleset("COLUMNHEADERS", $styles, false, "HTML2PDF");

    // Page Headers for TCPDF driver ( this is the default )
    if ($reportico->pdf_engine == "tcpdf") {
        // Create Report Title Page Header on every page of PDF
        $reportico->createPageHeader("H1", 1, "{REPORT_TITLE}{STYLE border-width: 1 0 1 0; margin: 15px 0px 0px 0px; border-color: #000000; font-size: 18; border-style: solid;padding:5px 0px 5px 0px; height:1cm; background-color: #000000; color: #ffffff; text-align: center}");
        $reportico->setPageHeaderAttribute("H1", "ShowInHTML", "no");
        $reportico->setPageHeaderAttribute("H1", "ShowInPDF", "yes");
        $reportico->setPageHeaderAttribute("H1", "justify", "center");

        // Create Image on every page of PDF
        /*
        $reportico->createPageHeader("H2", 1, "{STYLE width: 100; height: 50; margin: 0 0 0 0; background-color: #003333; background-image:images/reportico100.png;}" );
        $reportico->setPageHeaderAttribute("H2", "ShowInHTML", "no" );
         */

        // Create Image on every page of PDF
        $reportico->createPageHeader("H3", 1, "Time: date('Y-m-d H:i:s'){STYLE font-size: 10; text-align: right; font-style: italic;}");
        $reportico->setPageHeaderAttribute("H3", "ShowInHTML", "no");
        $reportico->setPageHeaderAttribute("H3", "justify", "right");

        // Create Page No on bottom of PDF page
        $reportico->createPageFooter("F1", 2, "Page: {PAGE}{STYLE border-width: 1 0 0 0; margin: 40 0 0 0; font-style: italic; }");
    } else if ( $reportico->pdf_engine == "fpdf" ) // FPDF page headers
    {
        // Create Report Title Page Header on every page of PDF
        $reportico->createPageHeader("H1", 2, "{REPORT_TITLE}{STYLE border-width: 1 0 1 0; margin: 15px 0px 0px 0px; border-color: #000000; font-size: 18; border-style: solid;padding:5px 0px 5px 0px; height:1cm; background-color: #000000; color: #ffffff}");
        $reportico->setPageHeaderAttribute("H1", "ShowInHTML", "no");
        $reportico->setPageHeaderAttribute("H1", "ShowInPDF", "yes");
        $reportico->setPageHeaderAttribute("H1", "justify", "center");

        // Create Image on every page of PDF
        $reportico->createPageHeader("H3", 1, "Time: date('Y-m-d H:i:s'){STYLE font-size: 10; text-align: right; font-style: italic;}");
        $reportico->setPageHeaderAttribute("H3", "ShowInHTML", "no");
        $reportico->setPageHeaderAttribute("H3", "justify", "right");

        // Create Page No on bottom of PDF page
        $reportico->createPageFooter("F1", 2, "Page: {PAGE}{STYLE border-width: 1 0 0 0; margin: 40 0 0 0; font-style: italic; }");
    } else // PhantomJS page headers
    {
        // Create Report Title Page Header on every page of PDF
        //$reportico->createPageHeader("H1", 2, "{REPORT_TITLE}{STYLE border-width: 0 0 1 0; margin: 15px 0px 0px 0px; border-color: #000000; font-size: 18; border-style: solid;padding:0px 0px 0px 0px; width: 100%; background-color: inherit; color: #000}");
        //$reportico->setPageHeaderAttribute("H1", "ShowInHTML", "no");
        //$reportico->setPageHeaderAttribute("H1", "ShowInPDF", "yes");
        //$reportico->setPageHeaderAttribute("H1", "justify", "center");

        // Create Image on every page of PDF
        $reportico->createPageHeader("H3", 1, "Time: date('Y-m-d H:i:s'){STYLE font-size: 10; text-align: right; font-style: italic;float:right;}");
        $reportico->setPageHeaderAttribute("H3", "ShowInHTML", "no");
        $reportico->setPageHeaderAttribute("H3", "justify", "right");

        $reportico->createPageHeader("H4", 1, "<img src='http://127.0.0.1/newarc/images/reportico100.png' style='width: 100%'>{STYLE width: 100; height: 50; margin: 0 0 0 0; background-image:http://127.0.0.1/newarc/images/reportico100.png;}" );
        $reportico->createPageHeader("H4", 1, "<img src='http://127.0.0.1/newarc/images/reportico100.png' style='width: 100%'>{STYLE width: 100; height: 50; margin: 0 0 0 0; background-image:http://127.0.0.1/newarc/images/reportico100.png;}" );
        $reportico->setPageHeaderAttribute("H4", "ShowInHTML", "no" );

        // Create Page No on bottom of PDF page
        $reportico->createPageFooter("F1", 2, "Page: {PAGE} of {PAGETOTAL} {STYLE border-width: 1 0 0 0; margin: 0 0 0 0; font-style: italic; }");
    }
}
