<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://opendatarepository.org
 * @since      1.0.0
 *
 * @package    Odr_Amcsd_Search
 * @subpackage Odr_Amcsd_Search/admin/partials
 */
/**
 *
 * [
 *   odr-amcsd-search-display datatype_id = "738"
 *   general_search = "gen"
 *   chemistry_incl = "7055"
 *   mineral_name = "7052"
 *   sample_id = "7069"
 *   redirect_url = "/odr/amcsd_sample#/odr/search/display/2010"
 * ]
 *
 */

// Need to load AMCSD CSS

?>
<script type="text/javascript">
    let link = document.createElement("link");
    link.href = "/odr_amcsd/css/external/pure-min.css";
    link.type = "text/css";
    link.rel = "stylesheet";
    link.media = "screen,print";
    document.getElementsByTagName("head")[0].appendChild(link);

    link = document.createElement("link");
    link.href = "/odr_amcsd/css/external/pure-grids-responsive-min.css";
    link.type = "text/css";
    link.rel = "stylesheet";
    link.media = "screen,print";
    document.getElementsByTagName("head")[0].appendChild(link);

    link = document.createElement("link");
    link.href = "/odr_amcsd/css/odr_wordpress.1.8.0.css";
    link.type = "text/css";
    link.rel = "stylesheet";
    link.media = "screen,print";
    document.getElementsByTagName("head")[0].appendChild(link);

    link = document.createElement("link");
    link.href = "/odr_amcsd/css/themes/css_smart/smart_wordpress.1.8.0.css";
    link.type = "text/css";
    link.rel = "stylesheet";
    link.media = "screen,print";
    document.getElementsByTagName("head")[0].appendChild(link);

    link = document.createElement("link");
    link.href = "/odr_amcsd/css/themes/css_smart/style_wordpress.1.8.0.css";
    link.type = "text/css";
    link.rel = "stylesheet";
    link.media = "screen,print";
    document.getElementsByTagName("head")[0].appendChild(link);

</script>

<style type="text/css">
    .ODRDataField fieldset {
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .ODRDataField fieldset textarea,
    .ODRDataField fieldset input {
        background-color: transparent !important;
        border: none; !important;
    }
</style>
<h2>ODR Search Plugin Settings</h2>
<div class="pure-skin-odr" id="odr-main-content-wrapper">
    <div id="main" style="width: 100%">
        <div id="odr_content">
            <div id="ODRSearchContent" class="pure-u-1 pure-u-sm-2-3 pure-u-md-2-3 pure-u-xl-3-4" style="opacity: 1;">
                <div class="ODRCreatedBy pure-u-1 PadRight"><strong>Created by: </strong>amcsd@amcsd.info
                    <strong>on</strong> 2005-04-13 12:04:00 (UTC-5)
                    <strong>Last Modified by: </strong>David Hubler
                    <strong>on</strong> 2024-02-19 11:02:39 (UTC-5)
                </div>
                <div class="pure-u-1 clearfix" id="ODRSearchHeaderWrapper">
                    <div class="pure-u-1-2" id="ODRPublicExportButtons">
                        <button id="ODREditRecord" type="button" class="pure-button pure-button-primary" data-step="5"
                                data-intro="Click here to switch to &quot;Edit&quot; mode for this record.">Edit
                        </button>
                        <button id="ChooseView" type="button" class="pure-button pure-button-primary" data-step="12"
                                data-intro="Clicking this brings up a dialog of options for selecting from alternate layouts, or for creating one of your own.">
                            Choose View
                        </button>
                        <i id="ODRDownloadAllFilesIcon" class="fa fa-file-archive-o Pointer" title="Download files"></i><i
                                id="ODRAddRecord" class="fa fa-plus Pointer tooltip ODRAddRecord"
                                title="Click to add a record"
                                data-step="8"
                                data-intro="Clicking &quot;Add Record&quot; takes you to a page where you can create a new record for this database."></i>
                    </div>
                    <div class="pure-u-1-2" style="text-align: right">
                        <div>
                            <button id="ODRSearchResultsPrevious" class="pure-button pure-button-primary"
                                    onclick="changeResult('prev');" data-step="3"
                                    data-intro="Clicking this button will take you to the previous record in the search results list...">
                                <i class="fa fa-backward"></i><span>&nbsp;Prev</span></button>
                            <button id="ODRReturnToSearchResults" class="pure-button pure-button-primary"
                                    onclick="returnToSearchResults();" data-step="2"
                                    data-intro="Click here to return to the list of all records that matched your search.">
                                Browse Results
                                <div class="ODRBrowseLabels"><span id="ODRRecordSummary">Record 1 of 3487</span></div>
                            </button>
                            <button id="ODRSearchResultsNext" class="pure-button pure-button-primary"
                                    onclick="changeResult('next');" data-step="4"
                                    data-intro="...and this button will take you to the next record.">
                                <span>Next&nbsp;</span><i
                                        class="fa fa-forward"></i></button>
                        </div>
                    </div>
                </div>
                <div class="ODRFormWrap ODRResults pure-u-1">
                    <div id="DataType_763" class="ODRDataType pure-u-1">
                        <div class="ODRAccordionWrapper ODRFormAccordion">
                            <div class="ODRFieldArea accordion-content pure-u-1" id="FieldArea_691090">
                                <div rel="4707" class="ODRThemeElement pure-u-1 pure-u-md-1-1 pure-u-xl-1-1">
                                    <div class="ODRInnerBox">
                                        <div class="ODRDataField pure-u-1 pure-u-md-1-3 pure-u-xl-1-3"
                                             id="Field_691090_7150"
                                             rel="2052">
                                            <form class="pure-u-1" id="ViewForm_691090_7150">
                                                <fieldset><label for="Input_691090_7150" class="ODRFieldLabel"
                                                                 title="The id of the sample or sample fragment/child used in the analysis.">Child
                                                        AMCSD ID</label>
                                                    <div class="ODRFieldWrapper" id="Input_691090_7150"><input
                                                                id="MediumVarcharForm_691090_7150"
                                                                class="pure-u-1 Cursor"
                                                                type="text" value="R010174.1" readonly="readonly"></div>
                                                </fieldset>
                                            </form>
                                        </div><!-- End of #Field_691090_7150 -->
                                        <div class="ODRDataField pure-u-1 pure-u-md-16-24 pure-u-xl-16-24"
                                             id="Field_691090_7151"
                                             rel="2052">
                                            <form class="pure-u-1" id="ViewForm_691090_7151">
                                                <fieldset><label for="Input_691090_7151" class="ODRFieldLabel"
                                                                 title="Field description.">Sample Description</label>
                                                    <div class="ODRFieldWrapper" id="Input_691090_7151"><textarea
                                                                id="LongTextForm_691090_7151" class="pure-u-1 Cursor"
                                                                readonly="readonly"
                                                                style="height: 45.264px;">Powder</textarea>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div><!-- End of #Field_691090_7151 --></div><!-- End of .ODRInnerBox --></div>
                                <!-- End of .ThemeElement -->
                                <div rel="4710" class="ODRThemeElement pure-u-1 pure-u-md-1-1 pure-u-xl-1-1">
                                    <div class="ODRInnerBox">
                                        <div class="ODRChildDatatype" id="ChildTypeWrapper_766_691090">
                                            <!-- Start Graph Plugin override child html -->
                                            <div id="DataType_766" class="ODRDataType pure-u-1">
                                                <div class="ODRAccordionWrapper ODRFormAccordion"><h3
                                                            class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active"
                                                            role="tab" aria-expanded="true" aria-selected="true"
                                                            tabindex="0"><span
                                                                class="ui-icon ui-icon-triangle-1-s"></span><a>Powder
                                                            Spectra</a><span class="DatatypeTools"><span rel="766"><i
                                                                        id="datarecord_691091_public"
                                                                        class="tooltip fa fa-globe Cursor ODRActiveIcon"
                                                                        title="Child Record is Public"
                                                                        rel="691091"></i></span></span></h3>
                                                    <div class="ODRFieldArea accordion-content pure-u-1"
                                                         id="FieldArea_691091">
                                                        <div class="ODRGraphSpacer pure-u-1">
                                                            <div rel="4711"
                                                                 class="ODRThemeElement pure-u-1 pure-u-md-1-1 pure-u-xl-1-1">
                                                                <div class="ODRInnerBox">
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-4-24 pure-u-xl-4-24"
                                                                         id="Field_691091_7157" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7157">
                                                                            <fieldset><label for="Input_691091_7157"
                                                                                             class="ODRFieldLabel"
                                                                                             title="">a</label>
                                                                                <div class="ODRFieldWrapper"
                                                                                     id="Input_691091_7157">
                                                                                    <input id="ShortVarcharForm_691091_7157"
                                                                                           class="pure-u-1 Cursor"
                                                                                           type="text"
                                                                                           value="13.5957(7)"
                                                                                           readonly="readonly">
                                                                                </div>
                                                                            </fieldset>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7157 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-4-24 pure-u-xl-4-24"
                                                                         id="Field_691091_7158" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7158">
                                                                            <fieldset><label for="Input_691091_7158"
                                                                                             class="ODRFieldLabel"
                                                                                             title="">b</label>
                                                                                <div class="ODRFieldWrapper"
                                                                                     id="Input_691091_7158">
                                                                                    <input id="ShortVarcharForm_691091_7158"
                                                                                           class="pure-u-1 Cursor"
                                                                                           type="text"
                                                                                           value="18.1769(6)"
                                                                                           readonly="readonly">
                                                                                </div>
                                                                            </fieldset>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7158 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-4-24 pure-u-xl-4-24"
                                                                         id="Field_691091_7159" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7159">
                                                                            <fieldset><label for="Input_691091_7159"
                                                                                             class="ODRFieldLabel"
                                                                                             title="">c</label>
                                                                                <div class="ODRFieldWrapper"
                                                                                     id="Input_691091_7159">
                                                                                    <input id="ShortVarcharForm_691091_7159"
                                                                                           class="pure-u-1 Cursor"
                                                                                           type="text"
                                                                                           value="17.840(1)"
                                                                                           readonly="readonly">
                                                                                </div>
                                                                            </fieldset>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7159 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-4-24 pure-u-xl-4-24"
                                                                         id="Field_691091_7160" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7160">
                                                                            <fieldset><label for="Input_691091_7160"
                                                                                             class="ODRFieldLabel"
                                                                                             title="">alpha</label>
                                                                                <div class="ODRFieldWrapper"
                                                                                     id="Input_691091_7160">
                                                                                    <input id="ShortVarcharForm_691091_7160"
                                                                                           class="pure-u-1 Cursor"
                                                                                           type="text"
                                                                                           value="90."
                                                                                           readonly="readonly"></div>
                                                                            </fieldset>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7160 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-4-24 pure-u-xl-4-24"
                                                                         id="Field_691091_7161" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7161">
                                                                            <fieldset><label for="Input_691091_7161"
                                                                                             class="ODRFieldLabel"
                                                                                             title="">beta</label>
                                                                                <div class="ODRFieldWrapper"
                                                                                     id="Input_691091_7161">
                                                                                    <input id="ShortVarcharForm_691091_7161"
                                                                                           class="pure-u-1 Cursor"
                                                                                           type="text"
                                                                                           value="89.89(3)"
                                                                                           readonly="readonly">
                                                                                </div>
                                                                            </fieldset>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7161 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-4-24 pure-u-xl-4-24"
                                                                         id="Field_691091_7162" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7162">
                                                                            <fieldset><label for="Input_691091_7162"
                                                                                             class="ODRFieldLabel"
                                                                                             title="">gamma</label>
                                                                                <div class="ODRFieldWrapper"
                                                                                     id="Input_691091_7162">
                                                                                    <input id="ShortVarcharForm_691091_7162"
                                                                                           class="pure-u-1 Cursor"
                                                                                           type="text"
                                                                                           value="90."
                                                                                           readonly="readonly"></div>
                                                                            </fieldset>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7162 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-1-3 pure-u-xl-1-3"
                                                                         id="Field_691091_7163" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7163">
                                                                            <fieldset><label for="Input_691091_7163"
                                                                                             class="ODRFieldLabel"
                                                                                             title="">volume</label>
                                                                                <div class="ODRFieldWrapper"
                                                                                     id="Input_691091_7163">
                                                                                    <input id="ShortVarcharForm_691091_7163"
                                                                                           class="pure-u-1 Cursor"
                                                                                           type="text"
                                                                                           value="4408.8(4)"
                                                                                           readonly="readonly">
                                                                                </div>
                                                                            </fieldset>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7163 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-1-3 pure-u-xl-1-3"
                                                                         id="Field_691091_7164" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7164">
                                                                            <fieldset><label
                                                                                        class="ODRFieldLabel pure-u-1"
                                                                                        title="">Crystal
                                                                                    System</label><label
                                                                                        for="Input_691091_7164_7830"
                                                                                        class="pure-u-1 pure-u-md-1-1 ODRResults_radio"><input
                                                                                            id="Input_691091_7164_7830"
                                                                                            type="radio"
                                                                                            name="RadioGroup_691091_7164"
                                                                                            checked=""
                                                                                            disabled=""
                                                                                            class="SingleRadioGroup">

                                                                                    monoclinic
                                                                                </label></fieldset>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7164 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-24-24 pure-u-xl-24-24"
                                                                         id="Field_691091_7166" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7166">
                                                                            <div class="ODRFileDatafield">
                                                                                <div class="ODRFileDatafield_header pure-u-1">
                                                                                    <i
                                                                                            class="Pointer fa fa-download fa-lg ODRDownloadAllFiles"
                                                                                            title="Download all Files in this Datafield"></i>&nbsp;
                                                                                    <span title="">Cell Refinement Data</span>
                                                                                </div>
                                                                                <div id="File_130585"
                                                                                     class="ODRFileDatafield_file pure-u-1"><span
                                                                                            class="ODRFileSpacer">&nbsp;</span><span
                                                                                            class="ODRTruncateFilename"><span
                                                                                                class="ODRFileInfoDiv"><i
                                                                                                    class="fa fa-lg fa-info-circle fa-public"></i><span
                                                                                                    class="ODRFileInfo"><div><i
                                                                                                            class="fa fa-globe ODRPublicFile fa-public"></i>&nbsp;
                                        <span>File was made public on 2006-07-27</span></div><div><i
                                                                                                            class="fa fa-calendar"></i>&nbsp;
                                        Uploaded 2006-07-27 by David Hubler
                                    </div><div><i class="fa fa-file-o"></i>&nbsp;
                                        374 B
                                    </div></span></span><a class="ODRFileDownload"
                                                           title="Cell_Refinement_Data__3909.DAT" rel="130585">Cell_Refinement_Data__3909.DAT</a></span><span
                                                                                            id="ODRFileDecrypt_130585_overlay"
                                                                                            class="ODRFakeProgressBar_overlay"
                                                                                            style="visibility:hidden;"><span
                                                                                                id="ODRFileDecrypt_130585_progress"
                                                                                                class="ODRFakeProgressBar"></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7166 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-24-24 pure-u-xl-24-24"
                                                                         id="Field_691091_7167" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7167">
                                                                            <div class="ODRFileDatafield">
                                                                                <div class="ODRFileDatafield_header pure-u-1">
                                                                                    <i
                                                                                            class="Pointer fa fa-download fa-lg ODRDownloadAllFiles"
                                                                                            title="Download all Files in this Datafield"></i>&nbsp;
                                                                                    <span title="">Cell Refinement Output Data</span>
                                                                                </div>
                                                                                <div id="File_130586"
                                                                                     class="ODRFileDatafield_file pure-u-1"><span
                                                                                            class="ODRFileSpacer">&nbsp;</span><span
                                                                                            class="ODRTruncateFilename"><span
                                                                                                class="ODRFileInfoDiv"><i
                                                                                                    class="fa fa-lg fa-info-circle fa-public"></i><span
                                                                                                    class="ODRFileInfo"><div><i
                                                                                                            class="fa fa-globe ODRPublicFile fa-public"></i>&nbsp;
                                        <span>File was made public on 2006-07-27</span></div><div><i
                                                                                                            class="fa fa-calendar"></i>&nbsp;
                                        Uploaded 2006-07-27 by David Hubler
                                    </div><div><i class="fa fa-file-o"></i>&nbsp;
                                        1.7 Kb
                                    </div></span></span><a class="ODRFileDownload"
                                                           title="Cell_Refinement_Output_Data__3910.txt" rel="130586">Cell_Refinement_Output_Data__3910.txt</a></span><span
                                                                                            id="ODRFileDecrypt_130586_overlay"
                                                                                            class="ODRFakeProgressBar_overlay"
                                                                                            style="visibility:hidden;"><span
                                                                                                id="ODRFileDecrypt_130586_progress"
                                                                                                class="ODRFakeProgressBar"></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7167 -->
                                                                    <div class="ODRDataField pure-u-1 pure-u-md-24-24 pure-u-xl-24-24"
                                                                         id="Field_691091_7168" rel="2054">
                                                                        <form class="pure-u-1"
                                                                              id="ViewForm_691091_7168">
                                                                            <div class="ODRFileDatafield">
                                                                                <div class="ODRFileDatafield_header pure-u-1">
                                                                                    <i
                                                                                            class="Pointer fa fa-download fa-lg ODRDownloadAllFiles"
                                                                                            title="Download all Files in this Datafield"></i>&nbsp;
                                                                                    <span title="">DIF File</span></div>
                                                                                <div id="File_130587"
                                                                                     class="ODRFileDatafield_file pure-u-1"><span
                                                                                            class="ODRFileSpacer">&nbsp;</span><span
                                                                                            class="ODRTruncateFilename"><span
                                                                                                class="ODRFileInfoDiv"><i
                                                                                                    class="fa fa-lg fa-info-circle fa-public"></i><span
                                                                                                    class="ODRFileInfo"><div><i
                                                                                                            class="fa fa-globe ODRPublicFile fa-public"></i>&nbsp;
                                        <span>File was made public on 2006-07-27</span></div><div><i
                                                                                                            class="fa fa-calendar"></i>&nbsp;
                                        Uploaded 2006-07-27 by David Hubler
                                    </div><div><i class="fa fa-file-o"></i>&nbsp;
                                        14.2 Kb
                                    </div></span></span><a class="ODRFileDownload" title="DIF_File__3911.diff"
                                                           rel="130587">DIF_File__3911.diff</a></span><span
                                                                                            id="ODRFileDecrypt_130587_overlay"
                                                                                            class="ODRFakeProgressBar_overlay"
                                                                                            style="visibility:hidden;"><span
                                                                                                id="ODRFileDecrypt_130587_progress"
                                                                                                class="ODRFakeProgressBar"></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div><!-- End of #Field_691091_7168 -->
                                                                <!-- End of .ODRInnerBox --></div>
                                                            <!-- End of .ThemeElement -->
                                                            <div rel="4712"ODRInnerBox">
                                                        </div>
                                                    </div><!-- End of #FieldArea_691091 --></div>
                                                <!-- End of .FormAccordion -->
                                            </div><!-- end of #DataType_766 -->
                                            <!-- End Graph Plugin override child html --></div>
                                    </div><!-- End of .ODRInnerBox --></div><!-- End of .ThemeElement --></div>
                            <!-- End of #FieldArea_691090 --></div><!-- End of .FormAccordion --></div>
                    <!-- End of #DataType_763 -->
                </div><!-- End of .ODRFormWrap -->
            </div>
        </div>
    </div>
</div>
<form action="options.php" method="post">
    <?php
    settings_fields('odr_search_plugin_options');
    do_settings_sections($this->plugin_name); ?>
    <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>"/>
</form>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
