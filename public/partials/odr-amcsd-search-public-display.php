<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://opendatarepository.org
 * @since      1.0.0
 *
 * @package    Odr_Amcsd_Search
 * @subpackage Odr_Amcsd_Search/public/partials
 */

/*
    [
        odr-amcsd-search-display datatype_id = "738"
        general_search = "gen"
        chemistry_incl = "7055"
        mineral_name = "7052"
        sample_id = "7069"
        default_search = "2229"
        search_pictures = "2010"
        search_spectra = "111"
        redirect_url = "/odr/amcsd_sample#/odr/search/display"
    ]
*/

?>

<script type="text/javascript">
    // Declare variables for Search JS
    let search_options = [];
    search_options['datatype_id'] = "<?php echo $odr_amcsd_search_plugin_options['datatype_id']; ?>";
    search_options['general_search'] = "<?php echo $odr_amcsd_search_plugin_options['general_search']; ?>";
    search_options['chemistry_incl'] = "<?php echo $odr_amcsd_search_plugin_options['chemistry_incl']; ?>";
    search_options['mineral_name'] = "<?php echo $odr_amcsd_search_plugin_options['mineral_name']; ?>";
    search_options['author_names'] = "<?php echo $odr_amcsd_search_plugin_options['author_names']; ?>";
    search_options['a'] = "<?php echo $odr_amcsd_search_plugin_options['a']; ?>";
    search_options['b'] = "<?php echo $odr_amcsd_search_plugin_options['b']; ?>";
    search_options['c'] = "<?php echo $odr_amcsd_search_plugin_options['c']; ?>";
    search_options['alpha'] = "<?php echo $odr_amcsd_search_plugin_options['alpha']; ?>";
    search_options['beta'] = "<?php echo $odr_amcsd_search_plugin_options['beta']; ?>";
    search_options['gamma'] = "<?php echo $odr_amcsd_search_plugin_options['gamma']; ?>";
    search_options['intensity'] = "<?php echo $odr_amcsd_search_plugin_options['intensity']; ?>";
    search_options['d_spacing'] = "<?php echo $odr_amcsd_search_plugin_options['d_spacing']; ?>";
    search_options['2_theta'] = "<?php echo $odr_amcsd_search_plugin_options['2_theta']; ?>";
    search_options['crystal_system'] = "<?php echo $odr_amcsd_search_plugin_options['crystal_system']; ?>";
    search_options['CS'] = "<?php echo $odr_amcsd_search_plugin_options['crystal_system']; ?>";
    search_options['space_group'] = "<?php echo $odr_amcsd_search_plugin_options['space_group']; ?>";
    search_options['SG'] = "<?php echo $odr_amcsd_search_plugin_options['space_group']; ?>";
    search_options['redirect_url'] = "<?php echo $odr_amcsd_search_plugin_options['redirect_url']; ?>";
    search_options['default_search'] = "<?php echo $odr_amcsd_search_plugin_options['default_search']; ?>";
    search_options['amc_short_form'] = "<?php echo $odr_amcsd_search_plugin_options['amc_short_form']; ?>";
    search_options['cif'] = "<?php echo $odr_amcsd_search_plugin_options['cif']; ?>";
    search_options['wavelength'] = "<?php echo $odr_amcsd_search_plugin_options['cif']; ?>";
    search_options['x_values'] = "<?php echo $odr_amcsd_search_plugin_options['cif']; ?>";
    console.log('SEARCH OPTIONS', search_options)
</script>


<div id="AMCSDMainContent">
    <!-- frame enclosing table -->
    <div class="AMCSDForm">
        <form name="AMCSDInterfaceForm" id="AMCSDInterfaceForm">
            <div class="amcsd-search-form-section pure-u-1">
                <div class="section-labels pure-u-1 pure-u-md-7-24 pure-u-xl-7-24">
                    <label for="txt_mineral">
                        <a href="#AMCSDMineralList" rel="modal:open" class="AMCSDHelperLink">Mineral</a>
                    </label>
                </div>
                <div class="pure-u-1 pure-u-md-16-24 pure-u-xl-16-24">
                    <input class="pure-u-1" type="text" id="txt_mineral" name="Mineral" value="">
                </div>
            </div>
            <div class="pure-u-1">
                <div class="section-labels pure-u-1 pure-u-md-7-24 pure-u-xl-7-24">
                    <label for="txt_author">
                        <a href="#AMCSDAuthorList" rel="modal:open" class="AMCSDHelperLink">Author</a>
                    </label>
                </div>
                <div class="pure-u-1 pure-u-md-16-24 pure-u-xl-16-24">
                    <input class="pure-u-1" type="text" name="Author" id="txt_author" value="">
                </div>
            </div>

            <div class="amcsd-search-form-section pure-u-1">
                <div class="section-labels pure-u-1 pure-u-md-7-24 pure-u-xl-7-24">
                    <a onclick="togglePeriodicTable()" class="AMCSDHelperLink AMCSDChemistryLink">Chemistry</a>
                </div>
                <div class="pure-u-1 pure-u-md-16-24 pure-u-xl-16-24">
                    <div class="pure-u-1">
                        <label class="chemistry_labels pure-u-1" for="txt_chemistry_incl">Includes:</label>
                        <input class="pure-u-1" type="text" id="txt_chemistry_incl" name="txt_chemistry_incl" value="">
                    </div>
                    <div class="pure-u-1">
                        <label class="chemistry_labels pure-u-1" for="txt_chemistry_excl">Excludes:</label>
                        <input class="pure-u-1" type="text" id="txt_chemistry_excl" name="txt_chemistry_excl" value="">
                    </div>
                </div>
                <input type="hidden" id="chemistry_incl_txt">
                <input type="hidden" id="chemistry_excl_txt">
            </div>
            <!-- <div class="amcsd-search-form-section pure-u-1"> -->
                <div id="AMCSDPeriodicTable">
                    <div id="amcsd_periodic_table" style="overflow: visible;">
                        <div id="amcsd_periodic_table_contents" style="min-height: 200px; padding-top: 10px;">
                <table id="amcsd-periodic-table">
                    <tbody>
                    <tr>
                        <td>
                            <div class="periodic_table pt_hydrogen chem_ele_unselected"
                                 id="periodic_table_H">H
                            </div>
                        </td>
                        <td colspan="16" align="center" id="periodic_table_instructions">
                            <!--
                            Click an element: once &raquo; required, twice &raquo; possible, thrice
                            &raquo; exclude -->
                        </td>
                        <td>
                            <div class="pt_noble_gases periodic_table chem_ele_unselected"
                                 id="periodic_table_He">He
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Li">Li
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkaline_earth_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Be">Be
                            </div>
                        </td>
                        <td colspan="1"></td>
                        <td colspan="9">
                            <div style="width: 90%;text-align:center; cursor: pointer;  background:#ffdead;"
                                 class="periodic_table chem_ele_unselected"
                                 id="periodic_table_clear">Clear
                                Chemistry
                            </div>
                        </td>
                        <td>
                            <div class="pt_metalloid periodic_table chem_ele_unselected"
                                 id="periodic_table_B">
                                B
                            </div>
                        </td>
                        <td>
                            <div class="pt_nonmetal periodic_table chem_ele_unselected"
                                 id="periodic_table_C">
                                C
                            </div>
                        </td>
                        <td>
                            <div class="pt_nonmetal periodic_table chem_ele_unselected"
                                 id="periodic_table_N">
                                N
                            </div>
                        </td>
                        <td>
                            <div class="pt_nonmetal periodic_table chem_ele_unselected"
                                 id="periodic_table_O">
                                O
                            </div>
                        </td>
                        <td>
                            <div class="pt_halides periodic_table chem_ele_unselected"
                                 id="periodic_table_F">F
                            </div>
                        </td>
                        <td>
                            <div class="pt_noble_gases periodic_table chem_ele_unselected"
                                 id="periodic_table_Ne">Ne
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Na">Na
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkaline_earth_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Mg">Mg
                            </div>
                        </td>
                        <td colspan="1"></td>
                        <td colspan="9">
                            <div style="width: 90%;text-align:center; cursor: pointer; background:#ffdead;"
                                 class="periodic_table chem_ele_unselected" id="periodic_table_all">
                                Exclude&nbsp;all&nbsp;non-selected
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Al">Al
                            </div>
                        </td>
                        <td>
                            <div class="pt_metalloid periodic_table chem_ele_unselected"
                                 id="periodic_table_Si">
                                Si
                            </div>
                        </td>
                        <td>
                            <div class="pt_nonmetal periodic_table chem_ele_unselected"
                                 id="periodic_table_P">
                                P
                            </div>
                        </td>
                        <td>
                            <div class="pt_nonmetal periodic_table chem_ele_unselected"
                                 id="periodic_table_S">
                                S
                            </div>
                        </td>
                        <td>
                            <div class="pt_halides periodic_table chem_ele_unselected"
                                 id="periodic_table_Cl">
                                Cl
                            </div>
                        </td>
                        <td>
                            <div class="pt_noble_gases periodic_table chem_ele_unselected"
                                 id="periodic_table_Ar">Ar
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_K">K
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkaline_earth_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ca">Ca
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Sc">Sc
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ti">Ti
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_V">V
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Cr">Cr
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Mn">Mn
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Fe">Fe
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Co">Co
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ni">Ni
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Cu">Cu
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Zn">Zn
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ga">Ga
                            </div>
                        </td>
                        <td>
                            <div class="pt_metalloid periodic_table chem_ele_unselected"
                                 id="periodic_table_Ge">
                                Ge
                            </div>
                        </td>
                        <td>
                            <div class="pt_metalloid periodic_table chem_ele_unselected"
                                 id="periodic_table_As">
                                As
                            </div>
                        </td>
                        <td>
                            <div class="pt_nonmetal periodic_table chem_ele_unselected"
                                 id="periodic_table_Se">
                                Se
                            </div>
                        </td>
                        <td>
                            <div class="pt_halides periodic_table chem_ele_unselected"
                                 id="periodic_table_Br">
                                Br
                            </div>
                        </td>
                        <td>
                            <div class="pt_noble_gases periodic_table chem_ele_unselected"
                                 id="periodic_table_Kr">Kr
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Rb">Rb
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkaline_earth_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Sr">Sr
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Y">Y
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Zr">Zr
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Nb">Nb
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Mo">Mo
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Tc">Tc
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ru">Ru
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Rh">Rh
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Pd">Pd
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ag">Ag
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Cd">Cd
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_In">In
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Sn">Sn
                            </div>
                        </td>
                        <td>
                            <div class="pt_metalloid periodic_table chem_ele_unselected"
                                 id="periodic_table_Sb">
                                Sb
                            </div>
                        </td>
                        <td>
                            <div class="pt_metalloid periodic_table chem_ele_unselected"
                                 id="periodic_table_Te">
                                Te
                            </div>
                        </td>
                        <td>
                            <div class="pt_halides periodic_table chem_ele_unselected"
                                 id="periodic_table_I">I
                            </div>
                        </td>
                        <td>
                            <div class="pt_noble_gases periodic_table chem_ele_unselected"
                                 id="periodic_table_Xe">Xe
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Cs">Cs
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkaline_earth_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ba">Ba
                            </div>
                        </td>
                        <td>
                            <div style="text-align:center; cursor: pointer;  background:#ffb888; font-style: italic;"
                                 class="periodic_table chem_ele_unselected"
                                 id="periodic_table_lanthanides"
                                 title="Shortcut for the lanthanide elements.">Ln
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Hf">Hf
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ta">Ta
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_W">W
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Re">Re
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Os">Os
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ir">Ir
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Pt">Pt
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Au">Au
                            </div>
                        </td>
                        <td>
                            <div class="pt_transition_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Hg">Hg
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Tl">Tl
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Pb">Pb
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Bi">Bi
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Po">Po
                            </div>
                        </td>
                        <td>
                            <div class="pt_halides periodic_table chem_ele_unselected"
                                 id="periodic_table_At">
                                At
                            </div>
                        </td>
                        <td>
                            <div class="pt_noble_gases periodic_table chem_ele_unselected"
                                 id="periodic_table_Rn">Rn
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="pt_alkali_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Fr">Fr
                            </div>
                        </td>
                        <td>
                            <div class="pt_alkaline_earth_metals periodic_table chem_ele_unselected"
                                 id="periodic_table_Ra">Ra
                            </div>
                        </td>
                        <td>
                            <div style="text-align:center; cursor: pointer;  background:#ff99cc; font-style: italic;"
                                 class="periodic_table chem_ele_unselected"
                                 id="periodic_table_actinides"
                                 title="Shortcut for the actinide elements.">An
                            </div>
                        </td>
                        <!-- <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Rf" >104<br />Rf</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Db" >105<br />Db</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Sg" >106<br />Sg</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Bh" >107<br />Bh</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Hs" >108<br />Hs</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Mt" >109<br />Mt</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Ds" >110<br />Ds</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Ra" >111<br />Rg</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffc0c0;"    class="periodic_table chem_ele_unselected" id="periodic_table_Uub" >112<br />Uub</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffbbdd;"    class="periodic_table chem_ele_unselected" id="periodic_table_Uut" >113<br />Uut</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffbbdd;"    class="periodic_table chem_ele_unselected" id="periodic_table_Uuq" >114<br />Uuq</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffbbdd;"    class="periodic_table chem_ele_unselected" id="periodic_table_Uup" >115<br />Uup</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffbbdd;"    class="periodic_table chem_ele_unselected" id="periodic_table_Uuh" >116<br />Uuh</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#ffff99;"    class="periodic_table chem_ele_unselected" id="periodic_table_Uus" >117<br />Uus</div></td>
                        <td><div style="text-align:center; cursor: pointer;  background:#c0ffff;"    class="periodic_table chem_ele_unselected" id="periodic_table_Uuo">118<br />Uuo</div></td> -->
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right; font-size: 10px;">&nbsp;</td>
                        <td>
                            <div style="text-align:center; cursor: pointer; font-style: italic;"
                                 class="periodic_table amcsd_search_pt_alternate" id="periodic_table_lanthanides_alt"
                                 title="Shortcut for the lanthanide elements.">Ln
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_La">La
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Ce">Ce
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Pr">Pr
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Nd">Nd
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Pm">Pm
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Sm">Sm
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Eu">Eu
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Gd">Gd
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Tb">Tb
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Dy">Dy
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Ho">Ho
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Er">Er
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Tm">Tm
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Yb">Yb
                            </div>
                        </td>
                        <td>
                            <div class="pt_lanthanides periodic_table chem_ele_unselected"
                                 id="periodic_table_Lu">Lu
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right; font-size: 10px;">&nbsp;</td>
                        <td>
                            <div style="text-align:center; cursor: pointer; font-style: italic;"
                                 class="periodic_table amcsd_search_pt_alternate" id="periodic_table_actinides_alt"
                                 title="Shortcut for the actinide elements.">An
                            </div>
                        </td>
                        <td>
                            <div class="pt_actinides periodic_table chem_ele_unselected"
                                 id="periodic_table_Ac">
                                Ac
                            </div>
                        </td>
                        <td>
                            <div class="pt_actinides periodic_table chem_ele_unselected"
                                 id="periodic_table_Th">
                                Th
                            </div>
                        </td>
                        <td>
                            <div class="pt_actinides periodic_table chem_ele_unselected"
                                 id="periodic_table_Pa">
                                Pa
                            </div>
                        </td>
                        <td>
                            <div class="pt_actinides periodic_table chem_ele_unselected"
                                 id="periodic_table_U">
                                U
                            </div>
                        </td>
                        <!-- <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Np" >Np</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Pu" >94<br />Pu</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Am" >95<br />Am</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Cu" >96<br />Cm</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Bk" >97<br />Bk</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Cf" >98<br />Cf</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Es" >99<br />Es</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Fm" >100<br />Fm</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Md" >101<br />Md</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_No" >102<br />No</div></td>
                        <td class="pt_actinides periodic_table chem_ele_unselected" id="periodic_table_Lr" >103<br />Lr</div></td> -->
                    </tr>
                    </tbody>
                </table>
            </div>
                    </div>
                </div>
            <!-- </div> -->

            <div class="amcsd-search-form-section pure-u-1">
                <div class="section-labels pure-u-1 pure-u-md-7-24 pure-u-xl-7-24">
                    <label for="txt_cell_parameters">
                        <a href="#AMCSDCellParametersAndSymmetry" rel="modal:open" class="AMCSDHelperLink">Cell Parameters and Symmetry</a>
                    </label>
                </div>
                <div class="pure-u-1 pure-u-md-16-24 pure-u-xl-16-24">
                    <input class="pure-u-1" type="text" name="CellParam" id="txt_cell_parameters" value="">
                </div>
            </div>

            <div class="amcsd-search-form-section pure-u-1">
                <div class="section-labels pure-u-1 pure-u-md-7-24 pure-u-xl-7-24">
                    <label for="txt_diffraction">
                        <a href="#AMCSDDiffractionSearch" rel="modal:open" class="AMCSDHelperLink">Diffraction Search</a>
                    </label>
                </div>
                <div class="pure-u-1 pure-u-md-16-24 pure-u-xl-16-24">
                    <input class="pure-u-1" type="text" name="diff" id="txt_diffraction">
                </div>
            </div>

            <div class="amcsd-search-form-section pure-u-1">
                <div class="section-labels pure-u-1 pure-u-md-7-24 pure-u-xl-7-24">
                    <label for="txt_general">
                       General Search
                    </label>
                </div>
                <div class="pure-u-1 pure-u-md-16-24 pure-u-xl-16-24">
                    <input class="pure-u-1" type="text" name="Key" id="txt_general" value="">
                </div>
            </div>

            <div class="amcsd-search-form-section pure-u-1">
                <div class="section-labels pure-u-1 pure-u-md-7-24 pure-u-xl-7-24">
                    <label for="Viewing">
                        Display
                    </label>
                </div>
                <div class="pure-u-1 pure-u-md-16-24 pure-u-xl-16-24">
                    <input type="radio" id="ViewingAMCLongForm" name="Viewing" value="amclongform" checked="">
                    <label for="ViewingAMCLongForm">amc long form</label>
                    <input type="radio" id="ViewingAMCShortForm" name="Viewing" value="amcshortform">
                    <label for="ViewingAMCShortForm">amc short form</label>
                    <input type="radio" id="ViewingCIF" name="Viewing" value="cif">
                    <label for="ViewingCIF">cif</label>
                </div>
            </div>

            <div class="amcsd-search-form-section pure-u-1">
                <div class="section-labels pure-u-1 pure-u-md-7-24 pure-u-xl-7-24">
                </div>
                <div class="pure-u-1 pure-u-md-16-24 pure-u-xl-16-24">
                    <input type="button" value="Search" id="amcsd-search-form-submit">
                    <input type="button" value="Reset" id="amcsd-search-form-reset">
                </div>
            </div>
        </form>

        <div class="AMCSDInfoDiv">
            <div class="AMCSDContentRight">
                This page has been accessed 4605651 times.
                <br />&nbsp;
            </div>
            <div class="AMCSDContent">
                <b>Files downloaded since Apr 1, 2003:</b> 1169958259
                <br><b>Data Last Updated:</b> January 08, 2024
            </div>
        </div>
    </div>

    <div id="AMCSDMineralList" class="modal">
        <table>
            <tr>
                <td colspan="4" class="AMCSDMineralAlpha">
                    <span class="AMCSDMineralNameLetter">A</span>
                    <span class="AMCSDMineralNameLetter">B</span>
                    <span class="AMCSDMineralNameLetter">C</span>
                    <span class="AMCSDMineralNameLetter">D</span>
                    <span class="AMCSDMineralNameLetter">E</span>
                    <span class="AMCSDMineralNameLetter">F</span>
                    <span class="AMCSDMineralNameLetter">G</span>
                    <span class="AMCSDMineralNameLetter">H</span>
                    <span class="AMCSDMineralNameLetter">I</span>
                    <span class="AMCSDMineralNameLetter">J</span>
                    <span class="AMCSDMineralNameLetter">K</span>
                    <span class="AMCSDMineralNameLetter">L</span>
                    <span class="AMCSDMineralNameLetter">M</span>
                    <span class="AMCSDMineralNameLetter">N</span>
                    <span class="AMCSDMineralNameLetter">O</span>
                    <span class="AMCSDMineralNameLetter">P</span>
                    <span class="AMCSDMineralNameLetter">Q</span>
                    <span class="AMCSDMineralNameLetter">R</span>
                    <span class="AMCSDMineralNameLetter">S</span>
                    <span class="AMCSDMineralNameLetter">T</span>
                    <span class="AMCSDMineralNameLetter">U</span>
                    <span class="AMCSDMineralNameLetter">V</span>
                    <span class="AMCSDMineralNameLetter">W</span>
                    <span class="AMCSDMineralNameLetter">X</span>
                    <span class="AMCSDMineralNameLetter">Y</span>
                    <span class="AMCSDMineralNameLetter">Z</span>
                    <span class="AMCSDCloseModal"><a href="#close-modal" rel="modal:close">[ close ]</a></span>
                    <span class="AMCSDCloseModal" onclick="clearMineralNameList()">[ clear ]</span>
                </td>
            </tr>
            <?php
            try {
                include(__DIR__ . '/../../../../data-publisher/web/uploads/IMA/mineral_names.php');
                include(__DIR__ . '/../../../../data-publisher/web/uploads/IMA/mineral_names_update.php');
                $count = 0;
                $column_count = 0;
                $current_letter = 'a';
                asort($mineral_names, SORT_LOCALE_STRING);
                foreach ($mineral_names as $mineral_name) {
                    // Check if we match current letter
                    if(mb_strtolower(substr($mineral_name,0, 1)) !== $current_letter) {
                        // Force count to 4
                        $current_letter =  mb_strtolower(substr($mineral_name,0, 1));
                        $count = 4;
                        $column_count = 0;
                    }

                    if ($count % 4 === 0) {
                        ?><tr><?php
                    }
                    ?><td class="AMCSDMineralName"><?php print $mineral_name ?></td><?php
                    $column_count++;
                    if ($column_count === 4) {
                        ?></tr><?php
                        $column_count = 0;
                    }
                    $count++;
                }
            } catch (Exception $e) {
            }
            ?>
        </table>
    </div>


    <div id="AMCSDAuthorList" class="modal">
        <table>
            <tr>
                <td colspan="4" class="AMCSDAuthorAlpha">
                    <span class="AMCSDAuthorNameLetter">A</span>
                    <span class="AMCSDAuthorNameLetter">B</span>
                    <span class="AMCSDAuthorNameLetter">C</span>
                    <span class="AMCSDAuthorNameLetter">D</span>
                    <span class="AMCSDAuthorNameLetter">E</span>
                    <span class="AMCSDAuthorNameLetter">F</span>
                    <span class="AMCSDAuthorNameLetter">G</span>
                    <span class="AMCSDAuthorNameLetter">H</span>
                    <span class="AMCSDAuthorNameLetter">I</span>
                    <span class="AMCSDAuthorNameLetter">J</span>
                    <span class="AMCSDAuthorNameLetter">K</span>
                    <span class="AMCSDAuthorNameLetter">L</span>
                    <span class="AMCSDAuthorNameLetter">M</span>
                    <span class="AMCSDAuthorNameLetter">N</span>
                    <span class="AMCSDAuthorNameLetter">O</span>
                    <span class="AMCSDAuthorNameLetter">P</span>
                    <span class="AMCSDAuthorNameLetter">Q</span>
                    <span class="AMCSDAuthorNameLetter">R</span>
                    <span class="AMCSDAuthorNameLetter">S</span>
                    <span class="AMCSDAuthorNameLetter">T</span>
                    <span class="AMCSDAuthorNameLetter">U</span>
                    <span class="AMCSDAuthorNameLetter">V</span>
                    <span class="AMCSDAuthorNameLetter">W</span>
                    <span class="AMCSDAuthorNameLetter">X</span>
                    <span class="AMCSDAuthorNameLetter">Y</span>
                    <span class="AMCSDAuthorNameLetter">Z</span>
                    <span class="AMCSDCloseModal"><a href="#close-modal" rel="modal:close">[ close ]</a></span>
                    <span class="AMCSDCloseModal" onclick="clearAuthorNameList()">[ clear ]</span>
                </td>
            </tr>
            <?php
            try {
                $author_names = [];
                include(__DIR__ . '/../../../../data-publisher/web/uploads/IMA/author_names.php');
                include(__DIR__ . '/../../../../data-publisher/web/uploads/IMA/author_names_update.php');
                $count = 0;
                $column_count = 0;
                $current_letter = "a";
                if (!empty($author_names)) {
                    $author_names = array_unique($author_names);
                }
                asort($author_names, SORT_LOCALE_STRING);
                foreach ($author_names as $author_name) {
                    if($author_name === '') continue;

                    // Check if we match current letter
                    if( mb_strtolower(substr($author_name,0, 1)) !== $current_letter) {
                        // Force count to 4
                        $current_letter =  mb_strtolower(substr($author_name,0, 1));
                        $count = 4;
                        $column_count = 0;
                    }

                    if ($count % 4 === 0) {
                        ?><tr><?php
                    }
                    ?><td class="AMCSDAuthorName"><?php print $author_name ?></td><?php
                    $column_count++;
                    if ($column_count === 4) {
                        ?></tr><?php
                        $column_count = 0;
                    }
                    $count++;
                }
            } catch (Exception $e) {
            }
            ?>
        </table>

    </div>


    <div id="AMCSDCellParametersAndSymmetry" class="modal">

        <form name="AMCSDCellParamsForm" id="AMCSDCellParamsForm">
            <input type="hidden" name="page" value="cellparam">
            <center><h2><b>Cell Parameters and Symmetry</b></h2></center>
            <center>
                <table>
                    <tbody>
                    <tr>
                        <td></td>
                        <td id="one1">Lower Range</td>
                        <td id="two2">Upper Range</td>
                    </tr>
                    <tr>
                        <td>a</td>
                        <td><input type="text" name="La" size="10"></td>
                        <td><input type="text" name="Ua" onchange="ChangeA()" size="10"></td>
                        <td><input type="radio" name="Ranges" value="Range" size="20" checked="" onclick="Click1()">
                            Range
                        </td>
                    </tr>
                    <tr>
                        <td>b</td>
                        <td><input type="text" name="Lb" size="10"></td>
                        <td><input type="text" name="Ub" onchange="ChangeB()" size="10"></td>
                        <td><input type="radio" name="Ranges" value="Tolerance" onclick="Click2()" size="20"> Tolerance
                        </td>
                    </tr>
                    <tr>
                        <td>c</td>
                        <td><input type="text" name="Lc" size="10"></td>
                        <td><input type="text" name="Uc" onchange="ChangeC()" size="10"></td>
                    </tr>
                    <tr>
                        <td>alpha</td>
                        <td><input type="text" name="Lalpha" size="10"></td>
                        <td><input type="text" name="Ualpha" onchange="ChangeAl()" size="10"></td>
                    </tr>
                    <tr>
                        <td>beta</td>
                        <td><input type="text" name="Lbeta" size="10"></td>
                        <td><input type="text" name="Ubeta" onchange="ChangeBe()" size="10"></td>
                    </tr>
                    <tr>
                        <td>gamma</td>
                        <td><input type="text" name="Lgamma" size="10"></td>
                        <td><input type="text" name="Ugamma" size="10" onchange="ChangeGa()"></td>
                    </tr>

                    <tr>
                        <td>
                            space group
                        </td>
                        <td><select id="sg" name="sg">
                                <option value=""></option>
                                <option value="A-1"> A-1</option>
                                <option value="A2"> A2</option>
                                <option value="A2/a"> A2/a</option>
                                <option value="A2/m"> A2/m</option>
                                <option value="A2/n"> A2/n</option>
                                <option value="A2mm"> A2mm</option>
                                <option value="A2_122"> A2_122</option>
                                <option value="A2_1am"> A2_1am</option>
                                <option value="A2_1ma"> A2_1ma</option>
                                <option value="Aa"> Aa</option>
                                <option value="Aba2"> Aba2</option>
                                <option value="Abm2"> Abm2</option>
                                <option value="Abma"> Abma</option>
                                <option value="Abmm"> Abmm</option>
                                <option value="Acam"> Acam</option>
                                <option value="Acmm"> Acmm</option>
                                <option value="Ama2"> Ama2</option>
                                <option value="Amaa"> Amaa</option>
                                <option value="Amam"> Amam</option>
                                <option value="Amm2"> Amm2</option>
                                <option value="Amma"> Amma</option>
                                <option value="Ammm"> Ammm</option>
                                <option value="B-1"> B-1</option>
                                <option value="B2"> B2</option>
                                <option value="B2/b"> B2/b</option>
                                <option value="B2/m"> B2/m</option>
                                <option value="B2/n"> B2/n</option>
                                <option value="B2mb"> B2mb</option>
                                <option value="B2_1"> B2_1</option>
                                <option value="B2_1/d"> B2_1/d</option>
                                <option value="B2_1/m"> B2_1/m</option>
                                <option value="Bb"> Bb</option>
                                <option value="Bb2_1m"> Bb2_1m</option>
                                <option value="Bba2"> Bba2</option>
                                <option value="Bbam"> Bbam</option>
                                <option value="Bbcm"> Bbcm</option>
                                <option value="Bbmm"> Bbmm</option>
                                <option value="Bm"> Bm</option>
                                <option value="Bm2m"> Bm2m</option>
                                <option value="Bmab"> Bmab</option>
                                <option value="Bmam"> Bmam</option>
                                <option value="Bmmb"> Bmmb</option>
                                <option value="C-1"> C-1</option>
                                <option value="C-42b"> C-42b</option>
                                <option value="C1"> C1</option>
                                <option value="C2"> C2</option>
                                <option value="C2/a"> C2/a</option>
                                <option value="C2/c"> C2/c</option>
                                <option value="C2/m"> C2/m</option>
                                <option value="C222"> C222</option>
                                <option value="C222_1"> C222_1</option>
                                <option value="C2cb"> C2cb</option>
                                <option value="C2_1"> C2_1</option>
                                <option value="C2_1/d"> C2_1/d</option>
                                <option value="Cc"> Cc</option>
                                <option value="Ccc2"> Ccc2</option>
                                <option value="Ccca"> Ccca</option>
                                <option value="Cccm"> Cccm</option>
                                <option value="Ccm2_1"> Ccm2_1</option>
                                <option value="Ccmb"> Ccmb</option>
                                <option value="Ccmm"> Ccmm</option>
                                <option value="Cm"> Cm</option>
                                <option value="Cm2a"> Cm2a</option>
                                <option value="Cm2m"> Cm2m</option>
                                <option value="Cmc2_1"> Cmc2_1</option>
                                <option value="Cmca"> Cmca</option>
                                <option value="Cmcm"> Cmcm</option>
                                <option value="Cmm2"> Cmm2</option>
                                <option value="Cmma"> Cmma</option>
                                <option value="Cmmb"> Cmmb</option>
                                <option value="Cmmm"> Cmmm</option>
                                <option value="F-1"> F-1</option>
                                <option value="F-43c"> F-43c</option>
                                <option value="F-43m"> F-43m</option>
                                <option value="F-4d2"> F-4d2</option>
                                <option value="F1"> F1</option>
                                <option value="F2"> F2</option>
                                <option value="F2/d"> F2/d</option>
                                <option value="F2/m"> F2/m</option>
                                <option value="F23"> F23</option>
                                <option value="F2dd"> F2dd</option>
                                <option value="F2mm"> F2mm</option>
                                <option value="F4/mmm"> F4/mmm</option>
                                <option value="F4_132"> F4_132</option>
                                <option value="Fd"> Fd</option>
                                <option value="Fd-3m"> Fd-3m</option>
                                <option value="Fd2d"> Fd2d</option>
                                <option value="Fd3"> Fd3</option>
                                <option value="Fd3c"> Fd3c</option>
                                <option value="Fd3m"> Fd3m</option>
                                <option value="Fdd2"> Fdd2</option>
                                <option value="Fddd"> Fddd</option>
                                <option value="Fm-3m"> Fm-3m</option>
                                <option value="Fm2m"> Fm2m</option>
                                <option value="Fm3"> Fm3</option>
                                <option value="Fm3c"> Fm3c</option>
                                <option value="Fm3m"> Fm3m</option>
                                <option value="Fmm2"> Fmm2</option>
                                <option value="Fmmm"> Fmmm</option>
                                <option value="I-1"> I-1</option>
                                <option value="I-4"> I-4</option>
                                <option value="I-42d"> I-42d</option>
                                <option value="I-42m"> I-42m</option>
                                <option value="I-43d"> I-43d</option>
                                <option value="I-43m"> I-43m</option>
                                <option value="I-4c2"> I-4c2</option>
                                <option value="I-4m2"> I-4m2</option>
                                <option value="I2"> I2</option>
                                <option value="I2/a"> I2/a</option>
                                <option value="I2/b"> I2/b</option>
                                <option value="I2/c"> I2/c</option>
                                <option value="I2/m"> I2/m</option>
                                <option value="I222"> I222</option>
                                <option value="I23"> I23</option>
                                <option value="I2cm"> I2cm</option>
                                <option value="I2mb"> I2mb</option>
                                <option value="I2mm"> I2mm</option>
                                <option value="I2_1/a-3"> I2_1/a-3</option>
                                <option value="I2_12_12_1"> I2_12_12_1</option>
                                <option value="I2_13"> I2_13</option>
                                <option value="I4"> I4</option>
                                <option value="I4/m"> I4/m</option>
                                <option value="I4/mcm"> I4/mcm</option>
                                <option value="I4/mmm"> I4/mmm</option>
                                <option value="I422"> I422</option>
                                <option value="I432"> I432</option>
                                <option value="I4mm"> I4mm</option>
                                <option value="I4_1/a"> I4_1/a</option>
                                <option value="I4_1/acd"> I4_1/acd</option>
                                <option value="I4_1/amd"> I4_1/amd</option>
                                <option value="I4_122"> I4_122</option>
                                <option value="I4_132"> I4_132</option>
                                <option value="I4_1cd"> I4_1cd</option>
                                <option value="Ia"> Ia</option>
                                <option value="Ia-3d"> Ia-3d</option>
                                <option value="Ia3"> Ia3</option>
                                <option value="Ia3d"> Ia3d</option>
                                <option value="Ib"> Ib</option>
                                <option value="Iba2"> Iba2</option>
                                <option value="Ibam"> Ibam</option>
                                <option value="Ibca"> Ibca</option>
                                <option value="Ibm2"> Ibm2</option>
                                <option value="Ibmm"> Ibmm</option>
                                <option value="Icma"> Icma</option>
                                <option value="Im"> Im</option>
                                <option value="Im-3m"> Im-3m</option>
                                <option value="Im2m"> Im2m</option>
                                <option value="Im3"> Im3</option>
                                <option value="Im3m"> Im3m</option>
                                <option value="Ima2"> Ima2</option>
                                <option value="Imab"> Imab</option>
                                <option value="Imam"> Imam</option>
                                <option value="Imcb"> Imcb</option>
                                <option value="Imcm"> Imcm</option>
                                <option value="Imm2"> Imm2</option>
                                <option value="Imma"> Imma</option>
                                <option value="Immm"> Immm</option>
                                <option value="P-1"> P-1</option>
                                <option value="P-3"> P-3</option>
                                <option value="P-31c"> P-31c</option>
                                <option value="P-31m"> P-31m</option>
                                <option value="P-3c1"> P-3c1</option>
                                <option value="P-3m1"> P-3m1</option>
                                <option value="P-4"> P-4</option>
                                <option value="P-42c"> P-42c</option>
                                <option value="P-42m"> P-42m</option>
                                <option value="P-42_1c"> P-42_1c</option>
                                <option value="P-42_1m"> P-42_1m</option>
                                <option value="P-43m"> P-43m</option>
                                <option value="P-43n"> P-43n</option>
                                <option value="P-4b2"> P-4b2</option>
                                <option value="P-4m2"> P-4m2</option>
                                <option value="P-4n2"> P-4n2</option>
                                <option value="P-6"> P-6</option>
                                <option value="P-62c"> P-62c</option>
                                <option value="P-62m"> P-62m</option>
                                <option value="P-6c2"> P-6c2</option>
                                <option value="P-6m2"> P-6m2</option>
                                <option value="P1"> P1</option>
                                <option value="P2"> P2</option>
                                <option value="P2/a"> P2/a</option>
                                <option value="P2/b"> P2/b</option>
                                <option value="P2/c"> P2/c</option>
                                <option value="P2/m"> P2/m</option>
                                <option value="P2/n"> P2/n</option>
                                <option value="P222"> P222</option>
                                <option value="P222_1"> P222_1</option>
                                <option value="P22_12_1"> P22_12_1</option>
                                <option value="P23"> P23</option>
                                <option value="P2an"> P2an</option>
                                <option value="P2cm"> P2cm</option>
                                <option value="P2mm"> P2mm</option>
                                <option value="P2nn"> P2nn</option>
                                <option value="P2_1"> P2_1</option>
                                <option value="P2_1/a"> P2_1/a</option>
                                <option value="P2_1/b"> P2_1/b</option>
                                <option value="P2_1/c"> P2_1/c</option>
                                <option value="P2_1/m"> P2_1/m</option>
                                <option value="P2_1/n"> P2_1/n</option>
                                <option value="P2_122_1"> P2_122_1</option>
                                <option value="P2_12_12"> P2_12_12</option>
                                <option value="P2_12_12_1"> P2_12_12_1</option>
                                <option value="P2_13"> P2_13</option>
                                <option value="P2_1ab"> P2_1ab</option>
                                <option value="P2_1am"> P2_1am</option>
                                <option value="P2_1ca"> P2_1ca</option>
                                <option value="P2_1cn"> P2_1cn</option>
                                <option value="P2_1ma"> P2_1ma</option>
                                <option value="P2_1mn"> P2_1mn</option>
                                <option value="P2_1nb"> P2_1nb</option>
                                <option value="P2_1nm"> P2_1nm</option>
                                <option value="P3"> P3</option>
                                <option value="P312"> P312</option>
                                <option value="P31c"> P31c</option>
                                <option value="P31m"> P31m</option>
                                <option value="P321"> P321</option>
                                <option value="P3c1"> P3c1</option>
                                <option value="P3m1"> P3m1</option>
                                <option value="P3_1"> P3_1</option>
                                <option value="P3_112"> P3_112</option>
                                <option value="P3_121"> P3_121</option>
                                <option value="P3_2"> P3_2</option>
                                <option value="P3_212"> P3_212</option>
                                <option value="P3_221"> P3_221</option>
                                <option value="P4"> P4</option>
                                <option value="P4/m"> P4/m</option>
                                <option value="P4/m-32/m"> P4/m-32/m</option>
                                <option value="P4/mbm"> P4/mbm</option>
                                <option value="P4/mcc"> P4/mcc</option>
                                <option value="P4/mmm"> P4/mmm</option>
                                <option value="P4/mnc"> P4/mnc</option>
                                <option value="P4/n"> P4/n</option>
                                <option value="P4/nbm"> P4/nbm</option>
                                <option value="P4/ncc"> P4/ncc</option>
                                <option value="P4/nmm"> P4/nmm</option>
                                <option value="P4/nnc"> P4/nnc</option>
                                <option value="P42_12"> P42_12</option>
                                <option value="P432"> P432</option>
                                <option value="P4bm"> P4bm</option>
                                <option value="P4mm"> P4mm</option>
                                <option value="P4nc"> P4nc</option>
                                <option value="P4_1"> P4_1</option>
                                <option value="P4_122"> P4_122</option>
                                <option value="P4_12_12"> P4_12_12</option>
                                <option value="P4_132"> P4_132</option>
                                <option value="P4_2"> P4_2</option>
                                <option value="P4_2/m"> P4_2/m</option>
                                <option value="P4_2/mbc"> P4_2/mbc</option>
                                <option value="P4_2/mcm"> P4_2/mcm</option>
                                <option value="P4_2/mmc"> P4_2/mmc</option>
                                <option value="P4_2/mnm"> P4_2/mnm</option>
                                <option value="P4_2/n"> P4_2/n</option>
                                <option value="P4_2/nbc"> P4_2/nbc</option>
                                <option value="P4_2/ncm"> P4_2/ncm</option>
                                <option value="P4_2/nmc"> P4_2/nmc</option>
                                <option value="P4_2/nnm"> P4_2/nnm</option>
                                <option value="P4_232"> P4_232</option>
                                <option value="P4_2mc"> P4_2mc</option>
                                <option value="P4_2nm"> P4_2nm</option>
                                <option value="P4_3"> P4_3</option>
                                <option value="P4_322"> P4_322</option>
                                <option value="P4_32_12"> P4_32_12</option>
                                <option value="P4_332"> P4_332</option>
                                <option value="P6/m"> P6/m</option>
                                <option value="P6/mcc"> P6/mcc</option>
                                <option value="P6/mmm"> P6/mmm</option>
                                <option value="P622"> P622</option>
                                <option value="P6_1"> P6_1</option>
                                <option value="P6_222"> P6_222</option>
                                <option value="P6_3"> P6_3</option>
                                <option value="P6_3/m"> P6_3/m</option>
                                <option value="P6_3/mcm"> P6_3/mcm</option>
                                <option value="P6_3/mmc"> P6_3/mmc</option>
                                <option value="P6_322"> P6_322</option>
                                <option value="P6_3cm"> P6_3cm</option>
                                <option value="P6_3mc"> P6_3mc</option>
                                <option value="P6_422"> P6_422</option>
                                <option value="P6_5"> P6_5</option>
                                <option value="P6_522"> P6_522</option>
                                <option value="Pa"> Pa</option>
                                <option value="Pa3"> Pa3</option>
                                <option value="Pb"> Pb</option>
                                <option value="Pb2_1m"> Pb2_1m</option>
                                <option value="Pba2"> Pba2</option>
                                <option value="Pbaa"> Pbaa</option>
                                <option value="Pbam"> Pbam</option>
                                <option value="Pban"> Pban</option>
                                <option value="Pbc2_1"> Pbc2_1</option>
                                <option value="Pbca"> Pbca</option>
                                <option value="Pbcb"> Pbcb</option>
                                <option value="Pbcm"> Pbcm</option>
                                <option value="Pbcn"> Pbcn</option>
                                <option value="Pbm2"> Pbm2</option>
                                <option value="Pbma"> Pbma</option>
                                <option value="Pbmm"> Pbmm</option>
                                <option value="Pbmn"> Pbmn</option>
                                <option value="Pbn2_1"> Pbn2_1</option>
                                <option value="Pbna"> Pbna</option>
                                <option value="Pbnb"> Pbnb</option>
                                <option value="Pbnm"> Pbnm</option>
                                <option value="Pbnn"> Pbnn</option>
                                <option value="Pc"> Pc</option>
                                <option value="Pc2_1b"> Pc2_1b</option>
                                <option value="Pc2_1n"> Pc2_1n</option>
                                <option value="Pca2_1"> Pca2_1</option>
                                <option value="Pcab"> Pcab</option>
                                <option value="Pcam"> Pcam</option>
                                <option value="Pcan"> Pcan</option>
                                <option value="Pcca"> Pcca</option>
                                <option value="Pccn"> Pccn</option>
                                <option value="Pcm2_1"> Pcm2_1</option>
                                <option value="Pcmb"> Pcmb</option>
                                <option value="Pcmn"> Pcmn</option>
                                <option value="Pcnb"> Pcnb</option>
                                <option value="Pcnn"> Pcnn</option>
                                <option value="Pm"> Pm</option>
                                <option value="Pm-3m"> Pm-3m</option>
                                <option value="Pm2a"> Pm2a</option>
                                <option value="Pm2m"> Pm2m</option>
                                <option value="Pm3"> Pm3</option>
                                <option value="Pm3m"> Pm3m</option>
                                <option value="Pm3n"> Pm3n</option>
                                <option value="Pm:1"> Pm:1</option>
                                <option value="Pma2"> Pma2</option>
                                <option value="Pmab"> Pmab</option>
                                <option value="Pmam"> Pmam</option>
                                <option value="Pman"> Pman</option>
                                <option value="Pmc2_1"> Pmc2_1</option>
                                <option value="Pmcb"> Pmcb</option>
                                <option value="Pmcn"> Pmcn</option>
                                <option value="Pmm2"> Pmm2</option>
                                <option value="Pmma"> Pmma</option>
                                <option value="Pmmm"> Pmmm</option>
                                <option value="Pmmn"> Pmmn</option>
                                <option value="Pmn2_1"> Pmn2_1</option>
                                <option value="Pmna"> Pmna</option>
                                <option value="Pmnb"> Pmnb</option>
                                <option value="Pmnm"> Pmnm</option>
                                <option value="Pmnn"> Pmnn</option>
                                <option value="Pn"> Pn</option>
                                <option value="Pn2n"> Pn2n</option>
                                <option value="Pn2_1a"> Pn2_1a</option>
                                <option value="Pn2_1m"> Pn2_1m</option>
                                <option value="Pn3"> Pn3</option>
                                <option value="Pn3m"> Pn3m</option>
                                <option value="Pn3n"> Pn3n</option>
                                <option value="Pna2_1"> Pna2_1</option>
                                <option value="Pnaa"> Pnaa</option>
                                <option value="Pnab"> Pnab</option>
                                <option value="Pnam"> Pnam</option>
                                <option value="Pnan"> Pnan</option>
                                <option value="Pnc2"> Pnc2</option>
                                <option value="Pnca"> Pnca</option>
                                <option value="Pncb"> Pncb</option>
                                <option value="Pncm"> Pncm</option>
                                <option value="Pncn"> Pncn</option>
                                <option value="Pnm2_1"> Pnm2_1</option>
                                <option value="Pnma"> Pnma</option>
                                <option value="Pnmb"> Pnmb</option>
                                <option value="Pnmm"> Pnmm</option>
                                <option value="Pnmn"> Pnmn</option>
                                <option value="Pnn2"> Pnn2</option>
                                <option value="Pnna"> Pnna</option>
                                <option value="Pnnm"> Pnnm</option>
                                <option value="R-3"> R-3</option>
                                <option value="R-32/c"> R-32/c</option>
                                <option value="R-3c"> R-3c</option>
                                <option value="R-3m"> R-3m</option>
                                <option value="R3"> R3</option>
                                <option value="R32"> R32</option>
                                <option value="R3c"> R3c</option>
                                <option value="R3m"> R3m</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>
                            crystal system
                        </td>
                        <td><select id="csys" name="csys" onchange="Change()">
                                <option value=""></option>
                                <option value="cubic">cubic</option>
                                <option value="tetragonal">tetragonal</option>
                                <option value="orthorhombic">orthorhombic</option>
                                <option value="hexagonal">hexagonal</option>
                                <option value="rhombohedral">rhombohedral</option>
                                <option value="monoclinic1">monoclinic1</option>
                                <option value="monoclinic2">monoclinic2</option>
                                <option value="monoclinic3">monoclinic3</option>
                                <option value="triclinic">triclinic</option>
                            </select></td>
                    </tr>

                    </tbody>
                </table>

                <div id="CellParamLogicInterface">
                    <!--
                    Logic interface:<br>
                    <input type="radio" name="logic1" value="AND" checked=""> AND
                    <input type="radio" name="logic1" value="OR"> OR


                    ?
                    La
                    &Ua
                    &Ranges=Range
                    &Lb
                    &Ub
                    &Lc
                    &Uc
                    &Lalpha
                    &Ualpha
                    &Lbeta
                    &Ubeta
                    &Lgamma
                    &Ugamma
                    &sg
                    &csys

                    ?
                    La
                    &Ua
                    &Lb
                    &Ub
                    &Ranges=Tolerance
                    &Lc
                    &Uc
                    &Lalpha
                    &Ualpha
                    &Lbeta
                    &Ubeta
                    &Lgamma
                    &Ugamma
                    &sg
                    &csys


                    <br> -->
                    <input type="button" value="Submit" onclick="AMCSDSubmitCellParameters()">
                    <input type="button" value="Reset" onclick="ResetCellParametersForm()"><br>
                </div>


                <script language="JavaScript"><!--

                    function AMCSDSubmitCellParameters() {
                        let cell_param_string = '';

                        let range = jQuery('input[name="Ranges"]:checked').val();
                        if(range === "Range") {
                            if(jQuery('input[name="La"]').val().length > 0) {
                                cell_param_string += "a='>="
                                    + jQuery('input[name="La"]').val() + " "
                                    + "<=" + jQuery('input[name="Ua"]').val() + "', ";
                            }

                            if(jQuery('input[name="Lb"]').val().length > 0) {
                                cell_param_string += "b='>="
                                    + jQuery('input[name="Lb"]').val() + " "
                                    + "<=" + jQuery('input[name="Ub"]').val() + "', ";
                            }

                            if(jQuery('input[name="Lc"]').val().length > 0) {
                                cell_param_string += "c='>="
                                    + jQuery('input[name="Lc"]').val() + " "
                                    + "<=" + jQuery('input[name="Uc"]').val() + "', ";
                            }

                            if(jQuery('input[name="Lalpha"]').val().length > 0) {
                                cell_param_string += "alpha='>="
                                    + jQuery('input[name="Lalpha"]').val() + " "
                                    + "<=" + jQuery('input[name="Ualpha"]').val() + "', ";
                            }

                            if(jQuery('input[name="Lbeta"]').val().length > 0) {
                                cell_param_string += "beta='>="
                                    + jQuery('input[name="Lbeta"]').val() + " "
                                    + "<=" + jQuery('input[name="Ubeta"]').val() + "', ";
                            }

                            if(jQuery('input[name="Lgamma"]').val().length > 0) {
                                cell_param_string += "gamma='>="
                                    + jQuery('input[name="Lgamma"]').val() + " "
                                    + "<=" + jQuery('input[name="Ugamma"]').val() + "', ";
                            }


                        }
                        else {
                            // Tolerance
                            if(jQuery('input[name="La"]').val().length > 0) {
                                let variance = parseFloat(jQuery('input[name="La"]').val());
                                let value = parseFloat(jQuery('input[name="Ua"]').val());
                                cell_param_string += "a='>="
                                    + (value - variance) + " "
                                    + "<=" + (value + variance) + "', ";
                            }

                            if(jQuery('input[name="Lb"]').val().length > 0) {
                                let variance = parseFloat(jQuery('input[name="Lb"]').val());
                                let value = parseFloat(jQuery('input[name="Ub"]').val())
                                cell_param_string += "b='>="
                                    + (value - variance) + " "
                                    + "<=" + (value + variance) + "', ";
                            }

                            if(jQuery('input[name="Lc"]').val().length > 0) {
                                let variance = parseFloat(jQuery('input[name="Lc"]').val());
                                let value = parseFloat(jQuery('input[name="Uc"]').val())
                                cell_param_string += "c='>="
                                    + (value - variance) + " "
                                    + "<=" + (value + variance) + "', ";
                            }

                            if(jQuery('input[name="Lalpha"]').val().length > 0) {
                                let variance = parseFloat(jQuery('input[name="Lalpha"]').val());
                                let value = parseFloat(jQuery('input[name="Ualpha"]').val())
                                cell_param_string += "alpha='>="
                                    + (value - variance) + " "
                                    + "<=" + (value + variance) + "', ";
                            }

                            if(jQuery('input[name="Lbeta"]').val().length > 0) {
                                let variance = parseFloat(jQuery('input[name="Lbeta"]').val());
                                let value = parseFloat(jQuery('input[name="Ubeta"]').val())
                                cell_param_string += "beta='>="
                                    + (value - variance) + " "
                                    + "<=" + (value + variance) + "', ";
                            }

                            if(jQuery('input[name="Lgamma"]').val().length > 0) {
                                let variance = parseFloat(jQuery('input[name="Lgamma"]').val());
                                let value = parseFloat(jQuery('input[name="Ugamma"]').val())
                                cell_param_string += "gamma='>="
                                    + (value - variance) + " "
                                    + "<=" + (value + variance) + "', ";
                            }

                        }

                        let sg_object = jQuery('#sg');
                        console.log('Checking sg object')
                        if(sg_object.find(":selected").val() !== undefined) {
                            console.log('TEST sg_object')
                            let value = sg_object.find(":selected").val();
                            if(value !== '') {
                                cell_param_string += "SG='" + value + "', ";
                            }
                        }
                        /*
                        let cs_object = jQuery('#csys');
                        if(cs_object.find(":selected").val() !== undefined) {
                            console.log('TEST cs_object')
                            let value = cs_object.find(":selected").val();
                            if(value !== '') {
                                cell_param_string += "CS='" + value + "', ";
                            }
                        }

                         */

                        cell_param_string = cell_param_string.replace(/, $/,'');

                        jQuery("#txt_cell_parameters").val(cell_param_string);

                        jQuery(".close-modal").click();

                        return true;
                    }

                    function Click1() {
                        if (document.all) {
                            document.all['one1'].innerText = 'Lower Range';
                            document.all['two2'].innerText = 'Upper Range';
                        } else {
                            document.getElementById('one1').childNodes[0].nodeValue = 'Lower Range';
                            document.getElementById('two2').childNodes[0].nodeValue = 'Upper Range';
                        }
                        document.AMCSDCellParamsForm.Ranges[0].checked = true;
                    }

                    function Click2() {
                        if (document.all) {
                            document.all['one1'].innerText = 'Value';
                            document.all['two2'].innerText = 'Tolerance';
                        } else {
                            document.getElementById('one1').childNodes[0].nodeValue = 'Value';
                            document.getElementById('two2').childNodes[0].nodeValue = 'Tolerance';
                        }
                        document.AMCSDCellParamsForm.Ranges[1].checked = true;
                    }

                    var text = "";

                    // This is what it's expecting:
                    // a=1to2%20and%20b=3to4

                    /*

                            MODIFYING THIS FILE?
                            Watch out for hardcoded javascript field values. Adding/removing fields will break.

                    */

                    if (text.indexOf("and") >= 0) {
                        arr = text.split("and");
                        document.AMCSDCellParamsForm.elements[17].checked = true;
                    } else {
                        if (text.indexOf("or") >= 0) {
                            arr = text.split("or");
                            document.AMCSDCellParamsForm.elements[18].checked = true;
                        } else
                            arr = text.split(" ");
                    }
                    var count = 0;
                    if (text.indexOf("to") >= 0) {
                        while (count < arr.length) {
                            var arr1 = arr[count].split("=");
                            while (arr1[0].substring(0, 1) == ' ')
                                arr1[0] = arr1[0].substring(1, arr1[0].length);
                            while (arr1[0].substring(arr1[0].length - 1, arr1[0].length) == ' ')
                                arr1[0] = arr1[0].substring(0, arr1[0].length - 1);
                            if (arr1[0].indexOf("%") == 0)
                                arr1[0] = arr1[0].substring(3, arr1[0].length);
                            arr1[0] = "L" + arr1[0];
                            while (arr1[1].substring(0, 1) == ' ')
                                arr1[1] = arr1[1].substring(1, arr1[1].length);
                            while (arr1[1].substring(arr1[1].length - 1, arr1[1].length) == ' ')
                                arr1[1] = arr1[1].substring(0, arr1[1].length - 1);
                            if (arr1[0] != "Lsg") {
                                for (var i = 1; i < document.AMCSDCellParamsForm.elements.length; i++) {
                                    var name1 = document.AMCSDCellParamsForm.elements[i].name;
                                    //alert("name 1 is " + name1);
                                    if (arr1[0] == name1) {
                                        var arr2 = arr1[1].split("to");
                                        if (arr2[0].indexOf("%") == 0)
                                            arr2[0] = arr2[0].substring(3, arr2[0].length);
                                        if (arr2[1].indexOf("%") >= 0)
                                            arr2[1] = arr2[1].substring(0, arr2[1].length - 3);
                                        while (arr2[0].substring(0, 1) == ' ')
                                            arr2[0] = arr2[0].substring(1, arr2[0].length);
                                        while (arr2[0].substring(arr2[0].length - 1, arr2[0].length) == ' ')
                                            arr2[0] = arr2[0].substring(0, arr2[0].length - 1);
                                        while (arr2[1].substring(0, 1) == ' ')
                                            arr2[1] = arr2[1].substring(1, arr2[1].length);
                                        while (arr2[1].substring(arr2[1].length - 1, arr2[1].length) == ' ')
                                            arr2[1] = arr2[1].substring(0, arr2[1].length - 1);
                                        document.AMCSDCellParamsForm.elements[i].value = arr2[0];
                                        var k = i + 1;
                                        document.AMCSDCellParamsForm.elements[k].value = arr2[1];
                                    }
                                }
                            } else {
                                for (var k = 0; k < document.AMCSDCellParamsForm.sg.options.length; k++) {
                                    if (document.AMCSDCellParamsForm.sg.options[k].value == arr1[1])
                                        document.AMCSDCellParamsForm.sg.options[k].selected = true;
                                }
                            }
                            count = count + 1;
                        }
                    } else {
                        if (text.indexOf("(") >= 0) {
                            Click2();
                            var count = 0;
                            while (count < arr.length) {
                                var arr1 = arr[count].split("=");
                                //Removing leading and trailing blank spaces
                                while (arr1[0].substring(0, 1) == ' ')
                                    arr1[0] = arr1[0].substring(1, arr1[0].length);
                                while (arr1[0].substring(arr1[0].length - 1, arr1[0].length) == ' ')
                                    arr1[0] = arr1[0].substring(0, arr1[0].length - 1);
                                while (arr1[1].substring(0, 1) == ' ')
                                    arr1[1] = arr1[1].substring(1, arr1[1].length);
                                while (arr1[1].substring(arr1[1].length - 1, arr1[1].length) == ' ')
                                    arr1[1] = arr1[1].substring(0, arr1[1].length - 1);
                                if (arr1[0].indexOf("%") == 0)
                                    arr1[0] = arr1[0].substring(3, arr1[0].length);
                                arr1[0] = "L" + arr1[0];

                                if (arr1[0] != "Lsg") {
                                    for (var i = 0; i < document.AMCSDCellParamsForm.elements.length; i++) {
                                        var name1 = document.AMCSDCellParamsForm.elements[i].name;
                                        if (arr1[0] == name1) {
                                            var arr2 = arr1[1].split("(");
                                            if (arr2[0].indexOf("%") == 0)
                                                arr2[0] = arr2[0].substring(3, arr2[0].length);
                                            if (arr2[1].indexOf("%") >= 0)
                                                arr2[1] = arr2[1].substring(0, arr2[1].length - 3);
                                            var arr3 = arr2[1].split(")");
                                            if (arr3[0].indexOf("%") == 0)
                                                arr3[0] = arr3[0].substring(3, arr3[0].length);
                                            if (arr2[1].indexOf("%") >= 0)
                                                arr3[1] = arr3[1].substring(0, arr3[1].length - 3);
                                            if (arr2[0].indexOf(".") >= 0) {
                                                arr4 = arr2[0].split(".");
                                                len = arr4[1].length;
                                                var zero = "";
                                                for (var j = 0; j < len; j++)
                                                    zero = zero + "0";
                                                var div = "1" + zero;
                                                arr3[0] = arr3[0] / div;
                                            }
                                            document.AMCSDCellParamsForm.elements[i].value = arr2[0];
                                            var k = i + 1;
                                            document.AMCSDCellParamsForm.elements[k].value = arr3[0];
                                        }
                                    }
                                } else //If Space group is present
                                {
                                    for (var k = 0; k < document.AMCSDCellParamsForm.sg.options.length; k++) {
                                        if (document.AMCSDCellParamsForm.sg.options[k].value == arr1[1])
                                            document.AMCSDCellParamsForm.sg.options[k].selected = true;
                                    }
                                }
                                count += 1;
                                // ianj removed this line on 8/3/2005 kept overriding tolerance choice on return
                                //document.AMCSDCellParamsForm.elements[12].checked=true;
                            }
                        } else {
                            Click1();
                            var arr1 = text.split("=");
                            for (var k = 0; k < document.AMCSDCellParamsForm.sg.options.length; k++) {
                                if (document.AMCSDCellParamsForm.sg.options[k].value == arr1[1])
                                    document.AMCSDCellParamsForm.sg.options[k].selected = true;
                            }
                        }
                    }

                    // Crystal System Change
                    function Change() {
                        // Reset existing crystal system values
                        document.AMCSDCellParamsForm.Lalpha.value = '';
                        document.AMCSDCellParamsForm.Lbeta.value = '';
                        document.AMCSDCellParamsForm.Lgamma.value = '';
                        document.AMCSDCellParamsForm.Ualpha.value = '';
                        document.AMCSDCellParamsForm.Ubeta.value = '';
                        document.AMCSDCellParamsForm.Ugamma.value = '';

                        var system = document.AMCSDCellParamsForm.csys.options[document.AMCSDCellParamsForm.csys.selectedIndex].value;
                        if (system == "cubic") {
                            document.AMCSDCellParamsForm.Lalpha.value = 90;
                            document.AMCSDCellParamsForm.Lbeta.value = 90;
                            document.AMCSDCellParamsForm.Lgamma.value = 90;
                            if ((document.AMCSDCellParamsForm.elements[3].checked) == true) {
                                document.AMCSDCellParamsForm.Ualpha.value = 90;
                                document.AMCSDCellParamsForm.Ubeta.value = 90;
                                document.AMCSDCellParamsForm.Ugamma.value = 90;
                            } else {
                                document.AMCSDCellParamsForm.Ualpha.value = 0;
                                document.AMCSDCellParamsForm.Ubeta.value = 0;
                                document.AMCSDCellParamsForm.Ugamma.value = 0;
                            }
                        }
                        if (system == "tetragonal") {
                            document.AMCSDCellParamsForm.Lalpha.value = 90;
                            document.AMCSDCellParamsForm.Lbeta.value = 90;
                            document.AMCSDCellParamsForm.Lgamma.value = 90;
                            if ((document.AMCSDCellParamsForm.elements[3].checked) == true) {
                                document.AMCSDCellParamsForm.Ualpha.value = 90;
                                document.AMCSDCellParamsForm.Ubeta.value = 90;
                                document.AMCSDCellParamsForm.Ugamma.value = 90;
                            } else {
                                document.AMCSDCellParamsForm.Ualpha.value = 0;
                                document.AMCSDCellParamsForm.Ubeta.value = 0;
                                document.AMCSDCellParamsForm.Ugamma.value = 0;
                            }
                        }
                        if (system == "hexagonal") {
                            document.AMCSDCellParamsForm.Lalpha.value = 90;
                            document.AMCSDCellParamsForm.Lbeta.value = 90;
                            document.AMCSDCellParamsForm.Lgamma.value = 120;
                            if ((document.AMCSDCellParamsForm.elements[3].checked) == true) {
                                document.AMCSDCellParamsForm.Ualpha.value = 90;
                                document.AMCSDCellParamsForm.Ubeta.value = 90;
                                document.AMCSDCellParamsForm.Ugamma.value = 120;
                            } else {
                                document.AMCSDCellParamsForm.Ualpha.value = 0;
                                document.AMCSDCellParamsForm.Ubeta.value = 0;
                                document.AMCSDCellParamsForm.Ugamma.value = 0;
                            }
                        }
                        if (system == "monoclinic1") {
                            document.AMCSDCellParamsForm.Lalpha.value = 90;
                            document.AMCSDCellParamsForm.Lbeta.value = 90;
                            if ((document.AMCSDCellParamsForm.elements[3].checked) == true) {
                                document.AMCSDCellParamsForm.Ualpha.value = 90;
                                document.AMCSDCellParamsForm.Ubeta.value = 90;
                            } else {
                                document.AMCSDCellParamsForm.Ualpha.value = 0;
                                document.AMCSDCellParamsForm.Ubeta.value = 0;
                            }
                        }
                        if (system == "monoclinic2") {
                            document.AMCSDCellParamsForm.Lalpha.value = 90;
                            document.AMCSDCellParamsForm.Lgamma.value = 90;
                            if ((document.AMCSDCellParamsForm.elements[3].checked) == true) {
                                document.AMCSDCellParamsForm.Ualpha.value = 90;
                                document.AMCSDCellParamsForm.Ugamma.value = 90;
                            } else {
                                document.AMCSDCellParamsForm.Ualpha.value = 0;
                                document.AMCSDCellParamsForm.Ugamma.value = 0;
                            }
                        }
                        if (system == "monoclinic3") {
                            document.AMCSDCellParamsForm.Lgamma.value = 90;
                            document.AMCSDCellParamsForm.Lbeta.value = 90;
                            if ((document.AMCSDCellParamsForm.elements[3].checked) == true) {
                                document.AMCSDCellParamsForm.Ubeta.value = 90;
                                document.AMCSDCellParamsForm.Ugamma.value = 90;
                            } else {
                                document.AMCSDCellParamsForm.Ubeta.value = 0;
                                document.AMCSDCellParamsForm.Ugamma.value = 0;
                            }
                        }
                        if (system == "orthorhombic") {
                            document.AMCSDCellParamsForm.Lalpha.value = 90;
                            document.AMCSDCellParamsForm.Lbeta.value = 90;
                            document.AMCSDCellParamsForm.Lgamma.value = 90;
                            if ((document.AMCSDCellParamsForm.elements[3].checked) == true) {
                                document.AMCSDCellParamsForm.Ualpha.value = 90;
                                document.AMCSDCellParamsForm.Ubeta.value = 90;
                                document.AMCSDCellParamsForm.Ugamma.value = 90;
                            } else {
                                document.AMCSDCellParamsForm.Ualpha.value = 0;
                                document.AMCSDCellParamsForm.Ubeta.value = 0;
                                document.AMCSDCellParamsForm.Ugamma.value = 0;
                            }
                        }
                        if (document.AMCSDCellParamsForm.La.value != "") {
                            if (system == "cubic") {
                                document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.La.value;
                                document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.La.value;
                                document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Ua.value;
                                document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Ua.value;
                            }
                            if (system == "tetragonal") {
                                document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.La.value;
                                document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Ua.value;
                            }
                            if (system == "hexagonal") {
                                document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.La.value;
                                document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Ua.value;
                            }
                            if (system == "rhombohedral") {
                                document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.La.value;
                                document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Ua.value;
                                document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.La.value;
                                document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Ua.value;
                                document.AMCSDCellParamsForm.Lbeta.value = document.AMCSDCellParamsForm.Lalpha.value;
                                document.AMCSDCellParamsForm.Lgamma.value = document.AMCSDCellParamsForm.Lalpha.value;
                            }
                        }
                        if (document.AMCSDCellParamsForm.Lb.value != "") {
                            if (system == "cubic") {
                                document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lb.value;
                                document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.Lb.value;
                                document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Ub.value;
                                document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Ub.value;
                            }
                            if (system == "tetragonal") {
                                document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lb.value;
                                document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Ub.value;
                            }
                            if (system == "hexagonal") {
                                document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lb.value;
                                document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Ub.value;
                            }
                            if (system == "rhombohedral") {
                                document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lb.value;
                                document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Ub.value;
                                document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.Lb.value;
                                document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Ub.value;
                            }
                        }
                        if (document.AMCSDCellParamsForm.Lc.value != "") {
                            if (system == "cubic") {
                                document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lc.value;
                                document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.Lc.value;
                                document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Uc.value;
                                document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Uc.value;
                            }

                            if (system == "rhombohedral") {
                                document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lc.value;
                                document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Uc.value;
                                document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.Lc.value;
                                document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Uc.value;
                            }
                        }
                        if (document.AMCSDCellParamsForm.Lalpha.value != "") {
                            if (system == "rhombohedral") {
                                document.AMCSDCellParamsForm.Lbeta.value = document.AMCSDCellParamsForm.Lalpha.value;
                                document.AMCSDCellParamsForm.Ubeta.value = document.AMCSDCellParamsForm.Ualpha.value;
                                document.AMCSDCellParamsForm.Lgamma.value = document.AMCSDCellParamsForm.Lalpha.value;
                                document.AMCSDCellParamsForm.Ugamma.value = document.AMCSDCellParamsForm.Ualpha.value;
                            }
                        }
                        if (document.AMCSDCellParamsForm.Lbeta.value != "") {
                            if (system == "rhombohedral") {
                                document.AMCSDCellParamsForm.Lalpha.value = document.AMCSDCellParamsForm.Lbeta.value;
                                document.AMCSDCellParamsForm.Ualpha.value = document.AMCSDCellParamsForm.Ubeta.value;
                                document.AMCSDCellParamsForm.Lgamma.value = document.AMCSDCellParamsForm.Lbeta.value;
                                document.AMCSDCellParamsForm.Ugamma.value = document.AMCSDCellParamsForm.Ubeta.value;
                            }
                        }
                        if (document.AMCSDCellParamsForm.Lgamma.value != "") {
                            if (system == "rhombohedral") {
                                document.AMCSDCellParamsForm.Lalpha.value = document.AMCSDCellParamsForm.Lgamma.value;
                                document.AMCSDCellParamsForm.Ualpha.value = document.AMCSDCellParamsForm.Ugamma.value;
                                document.AMCSDCellParamsForm.Lbeta.value = document.AMCSDCellParamsForm.Lgamma.value;
                                document.AMCSDCellParamsForm.Ubeta.value = document.AMCSDCellParamsForm.Ugamma.value;
                            }
                        }
                    }

                    function ResetCellParametersForm() {
                        document.AMCSDCellParamsForm.elements[1].value = "";
                        document.AMCSDCellParamsForm.elements[2].value = "";
                        document.AMCSDCellParamsForm.elements[3].value = "";
                        document.AMCSDCellParamsForm.elements[4].value = "";
                        document.AMCSDCellParamsForm.elements[5].value = "";
                        document.AMCSDCellParamsForm.elements[6].value = "";
                        document.AMCSDCellParamsForm.elements[7].value = "";
                        document.AMCSDCellParamsForm.elements[8].value = "";
                        document.AMCSDCellParamsForm.elements[9].value = "";
                        document.AMCSDCellParamsForm.elements[10].value = "";
                        document.AMCSDCellParamsForm.elements[11].value = "";
                        document.AMCSDCellParamsForm.elements[12].value = "";
                        document.AMCSDCellParamsForm.elements[13].value = "";
                        document.AMCSDCellParamsForm.elements[14].value = "";
                    }

                    function ChangeA() {
                        var system = document.AMCSDCellParamsForm.csys.options[document.AMCSDCellParamsForm.csys.selectedIndex].value;
                        if (system == "cubic") {
                            document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.La.value;
                            document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.La.value;
                            document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Ua.value;
                            document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Ua.value;
                        }
                        if (system == "tetragonal") {
                            document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.La.value;
                            document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Ua.value;
                        }
                        if (system == "hexagonal") {
                            document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.La.value;
                            document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Ua.value;
                        }
                        if (system == "rhombohedral") {
                            document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.La.value;
                            document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Ua.value;
                            document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.La.value;
                            document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Ua.value;
                        }
                    }

                    function ChangeB() {
                        var system = document.AMCSDCellParamsForm.csys.options[document.AMCSDCellParamsForm.csys.selectedIndex].value;
                        if (system == "cubic") {
                            document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lb.value;
                            document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.Lb.value;
                            document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Ub.value;
                            document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Ub.value;
                        }
                        if (system == "tetragonal") {
                            document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lb.value;
                            document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Ub.value;
                        }
                        if (system == "hexagonal") {
                            document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lb.value;
                            document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Ub.value;
                        }
                        if (system == "rhombohedral") {
                            document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lb.value;
                            document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Ub.value;
                            document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.Lb.value;
                            document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Ub.value;
                        }
                    }

                    function ChangeC() {
                        var system = document.AMCSDCellParamsForm.csys.options[document.AMCSDCellParamsForm.csys.selectedIndex].value;
                        if (system == "cubic") {
                            document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lc.value;
                            document.AMCSDCellParamsForm.Lb.value = document.AMCSDCellParamsForm.Lc.value;
                            document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Uc.value;
                            document.AMCSDCellParamsForm.Ub.value = document.AMCSDCellParamsForm.Uc.value;
                        }
                        if (system == "tetragonal") {
                            document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lc.value;
                            document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Uc.value;
                        }
                        if (system == "hexagonal") {
                            document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lc.value;
                            document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Uc.value;
                        }
                        if (system == "rhombohedral") {
                            document.AMCSDCellParamsForm.La.value = document.AMCSDCellParamsForm.Lc.value;
                            document.AMCSDCellParamsForm.Ua.value = document.AMCSDCellParamsForm.Uc.value;
                            document.AMCSDCellParamsForm.Lc.value = document.AMCSDCellParamsForm.Lc.value;
                            document.AMCSDCellParamsForm.Uc.value = document.AMCSDCellParamsForm.Uc.value;
                        }
                    }

                    function ChangeAl() {
                        var system = document.AMCSDCellParamsForm.csys.options[document.AMCSDCellParamsForm.csys.selectedIndex].value;
                        if (system == "rhombohedral") {
                            document.AMCSDCellParamsForm.Lbeta.value = document.AMCSDCellParamsForm.Lalpha.value;
                            document.AMCSDCellParamsForm.Ubeta.value = document.AMCSDCellParamsForm.Ualpha.value;
                            document.AMCSDCellParamsForm.Lgamma.value = document.AMCSDCellParamsForm.Lalpha.value;
                            document.AMCSDCellParamsForm.Ugamma.value = document.AMCSDCellParamsForm.Ualpha.value;
                        }
                    }

                    function ChangeBe() {
                        var system = document.AMCSDCellParamsForm.csys.options[document.AMCSDCellParamsForm.csys.selectedIndex].value;
                        if (system == "rhombohedral") {
                            document.AMCSDCellParamsForm.Lalpha.value = document.AMCSDCellParamsForm.Lbeta.value;
                            document.AMCSDCellParamsForm.Ualpha.value = document.AMCSDCellParamsForm.Ubeta.value;
                            document.AMCSDCellParamsForm.Lgamma.value = document.AMCSDCellParamsForm.Lbeta.value;
                            document.AMCSDCellParamsForm.Ugamma.value = document.AMCSDCellParamsForm.Ubeta.value;
                        }
                    }

                    function ChangeGa() {
                        var system = document.AMCSDCellParamsForm.csys.options[document.AMCSDCellParamsForm.csys.selectedIndex].value;
                        if (system == "rhombohedral") {
                            document.AMCSDCellParamsForm.Lbeta.value = document.AMCSDCellParamsForm.Lgamma.value;
                            document.AMCSDCellParamsForm.Ubeta.value = document.AMCSDCellParamsForm.Ugamma.value;
                            document.AMCSDCellParamsForm.Lalpha.value = document.AMCSDCellParamsForm.Lgamma.value;
                            document.AMCSDCellParamsForm.Ualpha.value = document.AMCSDCellParamsForm.Ugamma.value;
                        }
                    }

                    //--></script>

                </p></center>
        </form>

        <div>
            In this window you have the option to search for crystal structures based on cell parameters and space group
            symmetry. The cell parameter constraints can be entered in one of two ways, either by establishing a range
            of values (for instance, a-cell ranges from 10 to 10.2 Ang), or by establishing a value and its tolerance
            (for instance, a-cell=10.1+/- 0.1). Not all fields need to be chosen. The list box labelled "crystal system"
            can be used to fill in field constraints if desired. However, crystal system is not a searchable field.
        </div>
        <div>
            In addition space group symmetry can also be defined by choosing a space group from the list box. The list
            box does not contain all possible space groups, but only those represented in the database.</font></p>
        </div>

    </div>

    <div id="AMCSDDiffractionSearch" class="modal">
        <h2>Diffraction Pattern Search/Match Routine</h2>

        <form name="DiffractionSearchForm">
            <input type="hidden" name="page" value="diff">
            <input type="hidden" name="toleranceHidden" value="">
            <input type="hidden" name="diffValuesHidden" value="">
            <input type="hidden" name="sortDirectionHidden" value="null">

            <div id="AMCSDDiffractionSearchFormContents">
                <b>Choose an option:</b>
                <table align="center" cellspacing="5" cellpadding="6" class="interface_table" width=350>
                    <tr>
                        <td><input type="radio" name="Type" value="d-spacing"  onclick="DSpacingAnalysis();"> d-spacing</td>
                        <td><input type="radio" name="Type" value="2-Theta" CHECKED onclick="ThetaSelection('Cu');"> 2-theta</td>
                        <td><input type="radio" name="Type" value="energy"   onclick="EnergySelection();"> Energy</td>
                    </tr>
                </table>
                <div id="myLayer2" class="t3">
                    <table class="interface_table">
                        <tr>
                            <td class="left_side"><input type="text" name="intensity" size="5" value="5"></td>
                            <td id="three" class="t1">Intensity Cutoff (%)</td>
                        </tr>
                    </table>
                </div>
                <div id="myLayer" class="t3">
                    <table class="interface_table">
                        <tr>
                            <td class="left_side"><input type="text" name="optional" size="5" value="Cu"></td>
                            <td id="two" class="t1">Wavelength ('Cu', 'Mo', or value in angstroms)</td>
                        </tr>
                    </table>
                </div>
                <table class="interface_table">
                    <tr>
                        <td id="one" class="t1">2-theta</td>
                        <td class="t1">Tolerance</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="TypeTxt" size="10"></td>
                        <td><input type="text" name="Tol" size="10" value=""></td>
                        <td><input type="button" class="formButton" name="Enter" value="Enter" onclick="addThetaValues();"></td>
                    </tr>
                </table>
                <table class="interface_table">
                    <tr>
                        <td>
                            <select name="diffValueSelect" size="10" class="diffSelect">
                                <option value=""> Enter Values Above...
                            </select>
                        </td>
                    </tr>
                </table>
                <table class="interface_table">
                    <tr>
                        <td NOWRAP>
                            <input type="button" class="formButton" value="Submit" onclick="submitDiffractionSearch()">
                            <input type="button" class="formButton" value="Clear All" onclick="Clearall()">
                            <input type="button" class="formButton" value="Delete Selected" onClick="deleteSelected()">
                            <input type="button" class="formButton" value="Sort" onclick="sortValues()">
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <P>
            The diffraction search is based on the positions of peaks with intensities
            greater than 5% using Cu radiation with 2-theta values below 60 deg.
        </P>

        <script type="text/javascript">
            var defaultValue = "Enter Values Above...";

            /*

        	if (document.DiffractionSearchForm.Type[1].checked) {
		        // then this is a 2-Theta search.
		        if (document.DiffractionSearchForm.optional.value.length == 0 || document.DiffractionSearchForm.optional.value == "0") {
			        alert("When performing a 2-theta search, you must enter a wavelength value.");
			        document.DiffractionSearchForm.optional.focus();
			                return false;
		        }
	        }
	        if (document.DiffractionSearchForm.diffValuesHidden.value.length == 0 || document.DiffractionSearchForm.diffValuesHidden.value == "") {
		     alert("When performing a search, you must first enter some values to search by.");
		     document.DiffractionSearchForm.TypeTxt.focus();
		     return false;
	        }

             */

            function submitDiffractionSearch() {
                // Intensity
                // Wavelength
                // 2 theta values
                console.log('Opt: ' + document.DiffractionSearchForm.diffValueSelect.options[0].text);
                console.log('Type: ' + document.DiffractionSearchForm.Type.value);
                console.log('Intensity: ' + document.DiffractionSearchForm.intensity.value);
                console.log('Optional: ' + document.DiffractionSearchForm.optional.value);
                console.log('TypTxt: ' + document.DiffractionSearchForm.TypeTxt.value);
                console.log('Tol: ' + document.DiffractionSearchForm.Tol.value);
                console.log('diff Values: ' + document.DiffractionSearchForm.diffValuesHidden.value);
                let output_string = '';
                if(document.DiffractionSearchForm.Type.value === '2-Theta') {
                    // 2-Theta search
                    output_string = '2-Theta: ' + document.DiffractionSearchForm.diffValuesHidden.value
                        + ' (' + document.DiffractionSearchForm.Tol.value + ')'
                        + ' intensity: ' + document.DiffractionSearchForm.intensity.value
                        + ' wavelength: ' + document.DiffractionSearchForm.optional.value;
                }
                else if(document.DiffractionSearchForm.Type.value === 'd-spacing') {
                    // d-spacing
                    output_string = 'd-spacing: ' + document.DiffractionSearchForm.diffValuesHidden.value
                        + ' (' + document.DiffractionSearchForm.Tol.value + ')'
                        + ' intensity: ' + document.DiffractionSearchForm.intensity.value;
                }
                else {
                    // Energy
                    output_string = 'energy: ' + document.DiffractionSearchForm.diffValuesHidden.value
                        + ' (' + document.DiffractionSearchForm.Tol.value + ')'
                        + ' intensity: ' + document.DiffractionSearchForm.intensity.value
                        + ' theta: ' + document.DiffractionSearchForm.optional.value;
                    ;
                }
                jQuery("#txt_diffraction").val(output_string);
                jQuery(".close-modal").click();
            }

            /*
            * clear hidden and visible fields
            */
            function Clearall()
            {
                document.DiffractionSearchForm.diffValueSelect.options.length=1;
                document.DiffractionSearchForm.diffValueSelect.options[0].text	= defaultValue;
                document.DiffractionSearchForm.TypeTxt.value='';
                document.DiffractionSearchForm.Tol.value='';
                document.DiffractionSearchForm.diffValuesHidden.value='';
            }

            /*
            * minor sort subroutine
            */
            function sortasc(a,b)
            {
                if (a<b) return -1;
                if (a>b) return 1;
                return 0;
            }

            /*
            * minor sort subroutine
            */
            function sortdesc(a,b)
            {
                if (a>b) return -1;
                if (a<b) return 1;
                return 0;
            }

            /*
            * delete only selected lines in field
            */
            function deleteSelected() {
                var numLines = document.DiffractionSearchForm.diffValueSelect.options.length;
                var resultVisibleArray = new Array();
                var resultHiddenArray = new Array();
                var hiddenValuesArray = getArrayFromHiddenField();
                var x = 0;
                for (var i = 1; i < numLines; i++) {
                    if (!document.DiffractionSearchForm.diffValueSelect.options[i].selected) {
                        resultVisibleArray[x] = document.DiffractionSearchForm.diffValueSelect.options[i].text;
                        resultHiddenArray[x] = hiddenValuesArray[i-1];
                        x++;
                    }
                }
                putArrayIntoHiddenField(resultHiddenArray);
                populateSelectFromArray(resultVisibleArray);
            }

            /*
            * sort field values
            */
            function sortValues()
            {
                var elements = getArrayFromHiddenField();
                var tolerance = document.DiffractionSearchForm.toleranceHidden.value;
                var sortDirection = document.DiffractionSearchForm.sortDirectionHidden.value;
                if ((sortDirection == "null") || sortDirection == "desc") {
                    document.DiffractionSearchForm.sortDirectionHidden.value = "asc";
                    elements.sort(sortasc);
                } else {
                    document.DiffractionSearchForm.sortDirectionHidden.value = "desc";
                    elements.sort(sortdesc);
                }
                putArrayIntoHiddenField(elements);
                var resultArray = new Array();
                for(var i=0;i<elements.length;i++)
                {
                    var low = limitPrecision((parseFloat(elements[i])) - parseFloat(tolerance));
                    var high= limitPrecision((parseFloat(elements[i])) + parseFloat(tolerance));
                    var thisLine = prepareLineForDisplay(low, high);
                    resultArray[i] = thisLine;
                }
                populateSelectFromArray(resultArray);
            }

            /*
            * Take passed value and add to end of select list.
            */
            function addValueToSelect(stringToAdd) {
                var indexNum = document.DiffractionSearchForm.diffValueSelect.options.length;
                document.DiffractionSearchForm.diffValueSelect.options.length = indexNum + 1;
                document.DiffractionSearchForm.diffValueSelect.options[indexNum].text = stringToAdd;

            }

            /*
            * Take a passed array and replace contents of select field with values.
            */
            function populateSelectFromArray(resultArray) {
                document.DiffractionSearchForm.diffValueSelect.options.length = resultArray.length + 1;
                document.DiffractionSearchForm.diffValueSelect.options[0].text	= defaultValue;
                for (var i=0; i < resultArray.length; i++) {
                    document.DiffractionSearchForm.diffValueSelect.options[i+1].text = resultArray[i];
                }
            }

            /*
            * Limit precision as required, return string.
            */
            function limitPrecision(thisVal) {
                var precision = 7;
                var resultStr = thisVal + "";
                if (resultStr.length > precision) {
                    resultStr = resultStr.substr(0,precision)
                }
                return parseFloat(resultStr);
            }

            /*
            * create simple string of low to high based on passed values
            */
            function prepareLineForDisplay(low, high) {
                return low + " to " + high;
            }

            /*
            * get Array from hidden values field
            */
            function getArrayFromHiddenField() {
                var elements=document.DiffractionSearchForm.diffValuesHidden.value.split(",");
                elements.length = elements.length;
                return elements;
            }

            /*
            * put values from Array into hidden values field
            */
            function putArrayIntoHiddenField(thisArray) {
                var resultString = "";
                for (var i = 0; i < thisArray.length; i++) {
                    if (resultString.length > 0) resultString += ",";
                    resultString += thisArray[i];
                }
                document.DiffractionSearchForm.diffValuesHidden.value = resultString;
            }

            /*
            *	Iterates through the hidden fileds and populates the visible one.
            */
            function populateVisibleFieldFromHiddenArray(newTolerance) {
                var elements=getArrayFromHiddenField();
                var resultArray = new Array();
                for(var i=0;i<elements.length;i++)
                {
                    if ( elements[i] != null && elements[i].length > 0 ) {
                        var low = limitPrecision((parseFloat(elements[i])) - parseFloat(newTolerance));
                        var high= limitPrecision((parseFloat(elements[i])) + parseFloat(newTolerance));
                        var thisLine = prepareLineForDisplay(low, high);
                        resultArray[i] = thisLine;
                    }
                }
                populateSelectFromArray(resultArray);
            }

            /* This function is the one that actually populates the lines in the select. */
            function addThetaValues()
            {
                var newTolerance = document.DiffractionSearchForm.Tol.value;
                var newValue = document.DiffractionSearchForm.TypeTxt.value;
                if (isNaN(newValue)) {
                    if(document.DiffractionSearchForm.Type.value === '2-Theta') {
                        alert("Please enter a valid 2-Theta value.");
                    }
                    else if(document.DiffractionSearchForm.Type.value === 'd-spacing') {
                        alert("Please enter a valid d-spacing value.");
                    }
                    else {
                        alert("Please enter a valid energy value.");
                    }
                    return false;
                }
                if (isNaN(newTolerance) || newTolerance.length == 0) {
                    alert("Please enter a valid tolerance value.");
                    return false;
                }
                document.DiffractionSearchForm.toleranceHidden.value = newTolerance;
                // if tolerance is specified, but typetxt is not, then adjust all values for new tolerance
                if(newTolerance && (newValue=='')) {
                    populateVisibleFieldFromHiddenArray(newTolerance);
                } else {
                    // if typetxt is not null then do this (should we check to ensure that tolerance is specified too?)
                    if (newValue != '') {
                        // add the new value to the hidden string
                        if (document.DiffractionSearchForm.diffValuesHidden.value.length > 0) {
                            document.DiffractionSearchForm.diffValuesHidden.value += ",";
                        }
                        document.DiffractionSearchForm.diffValuesHidden.value += newValue;
                        var high = limitPrecision(parseFloat(newValue) +  parseFloat(newTolerance));
                        var low = limitPrecision(parseFloat(newValue) - parseFloat(newTolerance));
                        var thisLine = prepareLineForDisplay(low, high);
                        addValueToSelect(thisLine);
                    }
                    populateVisibleFieldFromHiddenArray(newTolerance);
                }
                // now, focus on the typetxt.
                document.DiffractionSearchForm.TypeTxt.value='';
                document.DiffractionSearchForm.TypeTxt.focus();
            }

            function shuffleLayers(textOne, textTwo, visibility) {
                if(document.all) {
                    document.all['one'].innerText = textOne;
                    document.all['two'].innerText = textTwo;
                    eval('document.all.myLayer'+'.style.visibility ="'+ visibility+'"');
                } else {
                    document.getElementById('one').childNodes[0].nodeValue = textOne;
                    document.getElementById('two').childNodes[0].nodeValue = textTwo;
                    var thisDiv = document.getElementById("myLayer");
                    eval('thisDiv' +'.style.visibility ="'+ visibility +'"');
                }
            }

            function ThetaSelection(optionalValue) {
                shuffleLayers("2-theta","Wavelength ('Cu', 'Mo', or value in angstroms)", "visible");
                document.DiffractionSearchForm.optional.disabled=false;
                document.DiffractionSearchForm.optional.focus();
                document.DiffractionSearchForm.optional.value=optionalValue;
            }

            function DSpacingAnalysis() {
                shuffleLayers("d-spacing","", "hidden");
                document.DiffractionSearchForm.TypeTxt.focus();
                document.DiffractionSearchForm.optional.disabled=true;
            }

            function EnergySelection() {
                shuffleLayers("Energy","theta", "visible");
                document.DiffractionSearchForm.optional.disabled=false;
                document.DiffractionSearchForm.optional.focus();
                document.DiffractionSearchForm.optional.value='6.5';
            }
        </script>
    </div>

</div>