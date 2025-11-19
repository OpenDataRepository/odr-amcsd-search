let amcsd_minerals = [];
(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    function summarySearchMode() {
        jQuery("#rsf_chemistry_excl_block").hide();
        jQuery("#rsf_chemistry_incl_block").hide();
        jQuery("#rsf_mineral_block").hide();
        jQuery("#rsf_general_block").hide();
        jQuery("#rsf_sort_block").hide();
        jQuery("#rsf_submit_block").addClass('summary-submit-block')
        jQuery("#odr_amcsd_search_dialog").addClass('summary-search-form')
        jQuery("#amcsd-search-form").addClass('summary-search-form')
    }

    jQuery(window).load(function () {
        jQuery.when(
            // jQuery.getScript( '/odr_rruff/uploads/IMA/master_tag_data.js'),
            // jQuery.getScript( '/odr_rruff/uploads/IMA/pm_tag_data.js'),
            // jQuery.getScript( script_path + 'first_occurrences.js' ),
            // jQuery.getScript( script_path + 'cellparams_range.js' ),  //
            // jQuery.getScript( script_path + 'cellparams_synonyms.js' ),
            jQuery.getScript('/odr_rruff/uploads/IMA/cellparams_data.js'),
            jQuery.getScript('/odr_rruff/uploads/IMA/cellparams_data_update.js'),
            jQuery.Deferred(function (deferred) {
                jQuery(deferred.resolve);
            })
        ).done(() => {
            // build array of mineral names found in cell params
            if(cellparams !== undefined) {
                for(let key of Object.keys(cellparams)) {
                    if(cellparams.hasOwnProperty(key)) {
                        let cell_param_obj = cellparams[key]
                        for (let mineralKey of Object.keys(cell_param_obj)){
                            if(cell_param_obj.hasOwnProperty(mineralKey)) {
                                let cell_param_data = cell_param_obj[mineralKey].split(/\|/)
                                amcsd_minerals.push(cell_param_data[2].toLowerCase())
                            }
                        }
                    }
                }
            }
            amcsd_minerals = amcsd_minerals.filter(getUniqueValues);
            amcsd_minerals = localeSort(amcsd_minerals)

                // Check if there are loaded search values
                let hash_params = location.hash.split('/');

                // Check if hash is a search page and reveal search block
                if (location.hash.match(/odr\/search\/display/)) {
                    $("#odr_amcsd_search_dialog").show('fast');
                    summarySearchMode();
                }

                // Check if a search is appended
                if (
                    hash_params[5] !== undefined
                    && hash_params[5].length > 0
                ) {
                    let search_query = UnicodeDecodeB64(hash_params[5])
                    // let search_query = hash_params[5];
                    console.log('Search Query: ', search_query)
                    for (const [key, value] of Object.entries(JSON.parse(search_query))) {
                        // console.log(`${key}: ${value}`);
                        for (const [option, option_value] of Object.entries(search_options)) {
                            if (option_value === key) {
                                switch (option) {
                                    case 'general_search':
                                        $("#txt_general").val(value);
                                        $("#rsf_general_block").show();
                                        break;
                                    case 'chemistry_incl':
                                        // split on spaces
                                        let chemistry_arr = value.split(/\s+/);
                                        for (let i = 0; i < chemistry_arr.length; i++) {
                                            if (!chemistry_arr[i].match(/^!/)) {
                                                // Includes
                                                let val = $("#txt_chemistry_incl").val()
                                                val = val + ", " + chemistry_arr[i]
                                                val = val.replace(/^,\s/, '');
                                                val = val.replace(/,\s$/, '');
                                                $("#txt_chemistry_incl").val(val)
                                                $("#chemistry_incl_txt").val(val)
                                            } else {
                                                // excludes
                                                let val = $("#txt_chemistry_excl").val()
                                                val = val + ", " + chemistry_arr[i].replace('!', '');

                                                val = val.replace(/^,\s/, '');
                                                val = val.replace(/,\s$/, '');
                                                $("#txt_chemistry_excl").val(val)
                                                $("#chemistry_excl_txt").val(val)
                                            }
                                        }
                                        $("#rsf_chemistry_incl_block").show();
                                        $("#rsf_chemistry_excl_block").show();

                                        break;
                                    case 'mineral_name':
                                        $("#txt_mineral").val(value);
                                        $("#rsf_mineral_block").show();
                                        break;
                                    case 'sample_id':
                                        $("#txt_mineral").val(value);
                                        $("#rsf_mineral_block").show();
                                        break;
                                    case 'amcsd_id':
                                        $("#txt_mineral").val(value);
                                        $("#rsf_mineral_block").show();
                                        break;
                                }
                            }
                        }

                    }

                }

                // Hide when hash is present except fields that are filled
                // Maybe make a quick general search version
                jQuery(".periodic_table").click(
                    function () {
                        if ($(this).attr('id') === 'periodic_table_clear') {
                            $('.periodic_table').removeClass('included');
                            $('.periodic_table').removeClass('excluded');
                            setChemistryFields();
                            return;
                        }

                        if ($(this).attr('id') === 'periodic_table_all') {
                            $(this).toggleClass('excluded');
                            setChemistryFields();
                            return;
                        }

                        // Check if element is "selected"
                        // !$("periodic_table_lanthanides").hasClass('included')

                        if (
                            $(this).hasClass("pt_lanthanides")
                            && (
                                $("#periodic_table_lanthanides").hasClass('included')
                                || $("#periodic_table_lanthanides").hasClass('excluded')
                            )
                        ) {
                            return
                        }
                        if (
                            $(this).hasClass("pt_actinides")
                            && (
                                $("#periodic_table_actinides").hasClass('included')
                                || $("#periodic_table_actinides").hasClass('excluded')
                            )
                        ) {
                            return
                        }

                        // Deal with lanthanides & actinides
                        let element = $(this).attr('id').replace('periodic_table_', '');

                        if (
                            element === 'lanthanides'
                            && (
                                (
                                    !$(this).hasClass("included")
                                    && !$(this).hasClass("excluded")
                                    && !$(".pt_lanthanides").hasClass('included') // .length === 0
                                    && !$(".pt_lanthanides").hasClass('excluded') // .length === 0
                                )
                                || (
                                    $(this).hasClass("included")
                                    && $(".pt_lanthanides").hasClass('included')
                                )
                                || (
                                    $(this).hasClass("excluded")
                                    && $(".pt_lanthanides").hasClass('excluded')
                                )
                            )
                        ) {
                            setInclExcl(this)
                            $(".pt_lanthanides").each(
                                function () {
                                    setInclExcl(this)
                                }
                            )
                        } else if (
                            element === 'actinides'
                            && (
                                (
                                    !$(this).hasClass("included")
                                    && !$(this).hasClass("excluded")
                                    && !$(".pt_actinides").hasClass('included') // .length === 0
                                    && !$(".pt_actinides").hasClass('excluded') // .length === 0
                                )
                                || (
                                    $(this).hasClass("included")
                                    && $(".pt_actinides").hasClass('included')
                                )
                                || (
                                    $(this).hasClass("excluded")
                                    && $(".pt_actinides").hasClass('excluded')
                                )
                            )
                        ) {
                            setInclExcl(this)
                            $(".pt_actinides").each(
                                function () {
                                    setInclExcl(this)
                                }
                            )
                        } else if (
                            element !== 'actinides'
                            && element !== 'lanthanides'
                        ) {
                            setInclExcl(this)
                        }

                        setChemistryFields();
                    }
                );

                jQuery("#reset_sample_search").click(function () {
                    $("#txt_mineral").val('');
                    $("#txt_general").val('');
                    $("#chemistry_incl_txt").val('');
                    $("#chemistry_excl_txt").val('');
                    $("#txt_chemistry_incl").val('');
                    $("#txt_chemistry_excl").val('');
                    $("#sel_sort").val($("#sel_sort option:first").val());
                    $("#sel_sort_dir").val($("#sel_sort_dir option:first").val());
                    $('.periodic_table').removeClass('included');
                    $('.periodic_table').removeClass('excluded');
                });


                jQuery("#AMCSDInterfaceForm input").keypress(function (e) {
                    if (e.which === 13) {
                        submitAmcsdSearchForm();
                        return false;
                    }
                });

                jQuery("#amcsd-search-form-reset").click(
                    // Use BtoA to encode
                    function () {
                        ResetForm();
                        return false;
                    }
                );

                jQuery("#amcsd-search-form-submit").click(
                    // Use BtoA to encode
                    function () {
                        submitAmcsdSearchForm();
                        return false;
                    }
                );

                // Prepare Mineral Name Modal
                jQuery(".AMCSDMineralNameLetter").click(function () {
                    amcsdFilterMineralNameList(jQuery(this).html())
                });

                // TODO Add filtering for valid AMCSD records
                amcsdFilterMineralNameList("A")

                jQuery(".AMCSDMineralName").click(function () {
                    let mineral_name = jQuery(this).html();
                    // If already selected, deselect and remove from list
                    if (jQuery(this).hasClass('AMCSDMineralNameSelected')) {
                        let txt_mineral = jQuery("#txt_mineral").val();
                        let mineral_name_comma = mineral_name + ', ';
                        if (txt_mineral.match(mineral_name_comma)) {
                            jQuery('#txt_mineral').val(
                                txt_mineral.replace(mineral_name_comma, '')
                            )
                        } else if (txt_mineral.match(mineral_name)) {
                            jQuery('#txt_mineral').val(
                                txt_mineral.replace(mineral_name, '')
                            )
                        }

                        // Log entry in minerals_selected
                        minerals_selected[mineral_name.substring(0,1).toLowerCase()]--;

                        jQuery(this).removeClass('AMCSDMineralNameSelected')
                    }
                    else if (!jQuery(this).hasClass('AMCSDNotFound')) {
                        // else select mineral
                        if (jQuery("#txt_mineral").val().length === 0) {
                            jQuery("#txt_mineral").val(
                                jQuery(this).html()
                            )
                        } else {
                            jQuery("#txt_mineral").val(
                                jQuery("#txt_mineral").val() + ', ' +
                                jQuery(this).html()
                            )
                        }

                        // Log entry in minerals_selected
                        if(minerals_selected[mineral_name.substring(0,1).toLowerCase()] === undefined) {
                            minerals_selected[mineral_name.substring(0,1).toLowerCase()] = 0;
                        }
                        minerals_selected[mineral_name.substring(0,1).toLowerCase()]++;

                        jQuery(this).addClass('AMCSDMineralNameSelected');
                    }

                    console.log('Check Mineral Name List: ', mineral_name.substring(0,1).toLowerCase());
                    checkMineralNameList(mineral_name.substring(0,1).toLowerCase());
                });

                // Prepare Author Name Modal
                jQuery(".AMCSDAuthorNameLetter").click(function () {
                    filterAuthorNameList(jQuery(this).html())
                });

                filterAuthorNameList("A")

                jQuery(".AMCSDAuthorName").click(function () {
                    let author_name = jQuery(this).html();
                    // If already selected, deselect and remove from list
                    if (jQuery(this).hasClass('AMCSDAuthorNameSelected')) {
                        let txt_author = jQuery("#txt_author").val();
                        let author_name_comma = author_name + ', ';
                        if (txt_author.match(author_name_comma)) {
                            jQuery('#txt_author').val(
                                txt_author.replace(author_name_comma, '')
                            )
                        } else if (txt_author.match(author_name)) {
                            jQuery('#txt_author').val(
                                txt_author.replace(author_name, '')
                            )
                        }
                        // Log entry in authors_selected
                        authors_selected[author_name.substring(0,1).toLowerCase()]--;

                        jQuery(this).removeClass('AMCSDAuthorNameSelected')
                    } else {
                        if (jQuery("#txt_author").val().length === 0) {
                            jQuery("#txt_author").val(
                                '"' + jQuery(this).html() + '"'
                            )
                        } else {
                            jQuery("#txt_author").val(
                                jQuery("#txt_author").val() + ', ' +
                                '"' + jQuery(this).html() + '"'
                            )
                        }

                        // Log entry in authors_selected
                        if(authors_selected[author_name.substring(0,1).toLowerCase()] === undefined) {
                            authors_selected[author_name.substring(0,1).toLowerCase()] = 0;
                        }
                        authors_selected[author_name.substring(0,1).toLowerCase()]++;

                        jQuery(this).addClass('AMCSDAuthorNameSelected')
                    }

                    console.log('Check Author Name List: ', author_name.substring(0,1).toLowerCase());
                    checkAuthorNameList(author_name.substring(0,1).toLowerCase());
                });
            });

        // Filter mineral names for existing AMCSD records
        // Can this be done reliably?
        // Use amcsd data from IMA Page

        function amcsdFilterMineralNameList(letter) {
            jQuery(".AMCSDMineralName").hide()
            jQuery(".AMCSDMineralName").removeClass("AMCSDNotFound")

            let regex = new RegExp('^' + letter, 'i');
            let mineral_list_objects = jQuery(".AMCSDMineralName");
            for(let item of mineral_list_objects) {
                // Add check if mineral name is in list from cellparams data
                let mineral_name = jQuery(item).html().toLowerCase();
                if (mineral_name.substring(0,1).localeCompare(letter.toLowerCase(), 'en', {sensitivity: "base"}) > 0) {
                    break;
                }
                if (mineral_name.match(regex)) {
                    // HiLoSearch to find mineral....??
                    jQuery(item).show()
                    if(!hiLoSearch(mineral_name, amcsd_minerals)) {
                        // fade minerals with no AMCSD record
                        jQuery(item).addClass('AMCSDNotFound')
                    }
                }
            }
        }

        let minerals_selected = [];
        function checkMineralNameList(letter) {
            console.log('Check Mineral Name List: ', letter)
            let regex = new RegExp('^' + letter, 'i');
            // If letter has something selected, bold letter
            if(minerals_selected[letter] !== undefined && minerals_selected[letter] > 0) {
                console.log('Check Mineral Name List: ', minerals_selected[letter])
                jQuery(".AMCSDMineralNameLetter").each(function () {
                    if(jQuery(this).html().match(regex)) {
                        jQuery(this).addClass('AMCSDAlphaSelected')
                    }
                })
            }
            else {
                jQuery(".AMCSDMineralNameLetter").each(function () {
                    if(jQuery(this).html().match(regex)) {
                        jQuery(this).removeClass('AMCSDAlphaSelected')
                    }
                })
            }
        }

        let authors_selected = [];
        function checkAuthorNameList(letter) {
            console.log('Check Author Name List: ', letter)
            let regex = new RegExp('^' + letter, 'i');
            // If letter has something selected, bold letter
            if(authors_selected[letter] !== undefined && authors_selected[letter] > 0) {
                console.log('Check Author Name List: ', authors_selected[letter])
                jQuery(".AMCSDAuthorNameLetter").each(function () {
                    if(jQuery(this).html().match(regex)) {
                        jQuery(this).addClass('AMCSDAlphaSelected')
                    }
                })
            }
            else {
                jQuery(".AMCSDAuthorNameLetter").each(function () {
                    if(jQuery(this).html().match(regex)) {
                        jQuery(this).removeClass('AMCSDAlphaSelected')
                    }
                })
            }
        }

        function filterAuthorNameList(letter) {
            let regex = new RegExp('^' + letter, 'i');
            jQuery(".AMCSDAuthorName").each(function () {
                if (jQuery(this).html().match(regex)) {
                    // jQuery(this).removeClass('AMCSDAuthorNameSelected')
                    jQuery(this).show()
                } else {
                    jQuery(this).hide()
                }
            })
        }

        function ResetForm() {
            jQuery("#txt_mineral").val('');
            jQuery("#txt_author").val('');
            jQuery("#txt_general").val('');
            jQuery("#txt_diffraction").val('');
            jQuery("#txt_cell_parameters").val('');
            jQuery("#chemistry_incl_txt").val('');
            jQuery("#chemistry_excl_txt").val('');
            jQuery("#txt_chemistry_incl").val('');
            jQuery("#txt_chemistry_excl").val('');
        }

        function validateSearchForm() {
            console.log('=== Starting Form Validation ===');

            // Clear all previous error messages
            jQuery('.validation-error').remove();

            let isValid = true;

            // Validate txt_diffraction field
            let diffractionValue = jQuery("#txt_diffraction").val().trim();
            console.log('Diffraction field value (raw):', diffractionValue === '' ? '(empty)' : diffractionValue);

            // Sanitize: replace multiple spaces with single space
            if (diffractionValue !== '') {
                diffractionValue = diffractionValue.replace(/\s+/g, ' ');
                console.log('Diffraction field value (sanitized):', diffractionValue);

                // Update the field with sanitized value
                jQuery("#txt_diffraction").val(diffractionValue);
            }

            if (diffractionValue !== '') {
                console.log('Validating diffraction field...');

                // Build regex pattern for diffraction validation
                // Format:
                //   2-theta: <numbers> (<tolerance>) intensity: <number> wavelength: <number|Cu|Mo>
                //   d-spacing: <numbers> (<tolerance>) intensity: <number>
                //   energy: <numbers> (<tolerance>) intensity: <number> theta: <number>

                // Pattern breakdown:
                // ^(2-theta|d-spacing|energy):\s  - type with colon and space
                // (\d+\.?\d*)(,\d+\.?\d*)*\s      - one or more comma-separated numbers with space after
                // \(\d+\.?\d*\)\s                 - tolerance in parens with space after
                // intensity:\s\d+\.?\d*           - intensity with value
                // (?:\swavelength:\s(Cu|Mo|\d+(?:\.\d+)?)|\stheta:\s\d+(?:\.\d+)?)? - optional wavelength (Cu/Mo/number) or theta (number)

                // Separate patterns for better debugging
                let basePattern = /^(2-theta|d-spacing|energy):\s(\d*?\.+?\d+|\d+?\.*?\d*)(,(\d*?\.+?\d+|\d+?\.*?\d*))*\s\((\d*?\.+?\d+|\d+?\.*?\d*)\)\sintensity:\s(\d*?\.+?\d+|\d+?\.*?\d*)/i;
                let wavelengthPattern = /\swavelength:\s(Cu|Mo|(\d*?\.+?\d+)|(\d+?\.*?\d*))$/i;
                let thetaPattern = /\stheta:\s(\d*?\.+?\d+|\d+?\.*?\d*)$/i;

                console.log('Testing patterns with current value [2]: "' + diffractionValue + '"');
                console.log('Base pattern test:', basePattern.test(diffractionValue));
                console.log('Has wavelength:', wavelengthPattern.test(diffractionValue));
                console.log('Has theta:', thetaPattern.test(diffractionValue));

                // Combined pattern
                let pattern = /^(2-theta|d-spacing|energy):\s(\d*?\.+?\d+|\d+?\.*?\d*)(,(\d*?\.+?\d+|\d+?\.*?\d*))*\s\((\d*?\.+?\d+|\d+?\.*?\d*)\)\sintensity:\s(\d*?\.+?\d+|\d+?\.*?\d*)(?:\swavelength:\s(?:Cu|Mo|(\d*?\.+?\d+)|(\d+?\.*?\d*))|\stheta:\s(\d*?\.+?\d+|\d+?\.*?\d*))?$/i;

                // Test the pattern and capture the result
                let testResult = pattern.test(diffractionValue);
                console.log('Combined pattern match result:', testResult);

                // If it has a wavelength or theta, extract and show it
                if (diffractionValue.toLowerCase().includes('wavelength:')) {
                    let wavelengthMatch = diffractionValue.match(/wavelength:\s*(\S+)/i);
                    if (wavelengthMatch) {
                        console.log('Extracted wavelength value:', wavelengthMatch[1]);
                    }
                } else if (diffractionValue.toLowerCase().includes('theta:')) {
                    let thetaMatch = diffractionValue.match(/theta:\s*(\S+)/i);
                    if (thetaMatch) {
                        console.log('Extracted theta value:', thetaMatch[1]);
                    }
                }

                console.log('Expected formats:');
                console.log('  2-theta: numbers (tolerance) intensity: value wavelength: value');
                console.log('  d-spacing: numbers (tolerance) intensity: value');
                console.log('  energy: numbers (tolerance) intensity: value theta: value');
                console.log('Wavelength value can be: a number, Cu, or Mo');
                console.log('Checking pattern match...');

                if (!testResult) {
                    isValid = false;
                    let errorMsg = '<div class="validation-error">Invalid format. Expected formats:<br>' +
                                   '&nbsp;&nbsp;2-Theta: numbers (tolerance) intensity: value wavelength: value<br>' +
                                   '&nbsp;&nbsp;d-spacing: numbers (tolerance) intensity: value<br>' +
                                   '&nbsp;&nbsp;energy: numbers (tolerance) intensity: value theta: value<br>' +
                                   'Wavelength can be: a number, Cu, or Mo</div>';
                    console.error('VALIDATION FAILED: Pattern does not match');
                    console.error('Error: Invalid format - see expected formats in console');
                    jQuery("#txt_diffraction").after(errorMsg);
                } else {
                    console.log('Pattern match: PASSED');

                    // Check if 2-theta requires wavelength
                    console.log('Checking type-specific requirements...');
                    let typePrefix = diffractionValue.toLowerCase().split(':')[0];
                    console.log('Detected type prefix:', typePrefix);

                    if (typePrefix === '2-theta') {
                        console.log('Type is 2-theta, checking for wavelength requirement...');
                        if (!diffractionValue.toLowerCase().includes('wavelength:')) {
                            isValid = false;
                            let errorMsg = '<div class="validation-error">2-Theta searches require a wavelength value</div>';
                            console.error('VALIDATION FAILED: 2-Theta requires wavelength');
                            console.error('Error:', '2-Theta searches require a wavelength value');
                            jQuery("#txt_diffraction").after(errorMsg);
                        } else {
                            console.log('Wavelength check: PASSED');
                        }
                    } else if (typePrefix === 'energy') {
                        console.log('Type is energy, checking for theta requirement...');
                        if (!diffractionValue.toLowerCase().includes('theta:')) {
                            isValid = false;
                            let errorMsg = '<div class="validation-error">Energy searches require a theta value</div>';
                            console.error('VALIDATION FAILED: Energy requires theta');
                            console.error('Error:', 'Energy searches require a theta value');
                            jQuery("#txt_diffraction").after(errorMsg);
                        } else {
                            console.log('Theta check: PASSED');
                        }
                    } else if (typePrefix === 'd-spacing') {
                        console.log('Type is d-spacing, no additional parameters required');
                    } else {
                        console.log('Type is unknown:', typePrefix);
                    }
                }
            } else {
                console.log('Diffraction field is empty, skipping validation');
            }

            if (isValid) {
                console.log('✓ VALIDATION SUCCESSFUL - Form is valid and ready for submission');
            } else {
                console.log('✗ VALIDATION FAILED - Form submission blocked');
            }
            console.log('=== End Form Validation ===');

            return isValid;
        }

        function submitAmcsdSearchForm() {
            console.log('Submit Search Form')

            // Validate form before submission
            if (!validateSearchForm()) {
                console.log('Form validation failed');
                return false;
            }

            // UnicodeDecodeB64("JUUyJTlDJTkzJTIwJUMzJUEwJTIwbGElMjBtb2Rl"); // "✓ à la mode"
            // Get mineral names or AMCSD IDS from txt_mineral
            let search_json = {
                "dt_id": search_options['datatype_id']
            };
            if ($("#txt_mineral").val().trim().match(/^R\d+$/i)) {
                // display specific mineral id
                // {"dt_id":"3","34":"r040034"}
                search_json[search_options['general_search']] = $("#txt_mineral").val().trim();
            } else if ($("#txt_mineral").val().trim() !== '') {
                // Check for commas (separated minerals)
                // search for IMA Mineral Display Name
                // {"dt_id":"3","18":"actinolite"}
                search_json[search_options['mineral_name']] = $("#txt_mineral").val().replaceAll(/,/g, ' ||').trim();
            }

            // Get General Text search field
            if ($("#txt_general").val().trim() !== '') {
                // {"dt_id":"3","gen":"quartz"}
                search_json[search_options['general_search']] = $("#txt_general").val().trim();
            }

            if ($("#txt_author").val().trim() !== '') {
                // {"dt_id":"3","gen":"quartz"}
                search_json[search_options['author_names']] = $("#txt_author").val().replaceAll(/,/g, ' ||').trim();
            }

            // Get chemistry includes
            if ($("#txt_chemistry_incl").val() !== '') {
                // {"dt_id":"3","21":"C"}
                search_json[search_options['chemistry_incl']] = $("#txt_chemistry_incl").val().trim().replaceAll(/,/g, ' ');
            }

            if ($("#txt_diffraction").val() !== '') {
                let diffraction_string = $("#txt_diffraction").val();
                let items = diffraction_string.split(/\s/);
                let tolerance = items[2].replace(/[()]/g, '');
                console.log('Tolerance: ', tolerance)
                let values = items[1].split(',');
                // Set the intensity
                search_json[search_options['intensity']] = '>=' + items[4];

                search_json[search_options['d_spacing']] = '';
                if(diffraction_string.match(/2-Theta/)) {
                    // Need to convert 2-Theta for d-spacing
                    // d = nLam/2sinTheta
                    for(let i= 0; i < values.length; i++) {
                        let d_low = 0
                        let d_high = 0
                        let wavelength = items[6];
                        let thetaLow = 2 * (Math.sin((parseFloat(values[0]) + parseFloat(tolerance)) / 2 * Math.PI / 180));
                        let thetaHigh = 2 * (Math.sin((parseFloat(values[0]) - parseFloat(tolerance)) / 2 * Math.PI / 180));
                        if (thetaLow === 0 || thetaHigh === 0) {
                            // error state
                            console.log('Error: 2-Theta search requires a wavelength value');
                            return false;
                        }
                        if (wavelength.match(/([0-9\.]+)/)) {
                            console.log('Wavelength: ', wavelength);
                            d_low = wavelength / thetaLow;
                            d_high = wavelength / thetaHigh;
                        } else if (wavelength.match(/[CU]+/i)) {
                            console.log('Wavelength: Cu');
                            d_low = 1.541838 / thetaLow;
                            d_high = 1.541838 / thetaHigh;
                        } else {
                            console.log('Wavelength: Mo');
                            d_low = 0.710730 / thetaLow;
                            d_high = 0.710730 / thetaHigh;
                        }
                        if (d_low > d_high) {
                            let tmp = d_low;
                            d_low = d_high;
                            d_high = tmp;
                        }

                        search_json[search_options['d_spacing']] += '>=' + Math.round((d_low) * 10000) / 10000
                            + ' <=' + Math.round((d_high) * 10000) / 10000;
                    }
                }
                else if(diffraction_string.match(/d-spacing/)) {
                    let value_string = '';
                    for (let i = 0; i < values.length; i++) {
                        value_string += '>=' + (parseFloat(values[i]) - parseFloat(tolerance))
                            + ' <=' + (parseFloat(values[i]) + parseFloat(tolerance)) + ', ';
                    }
                    value_string = value_string.replace(/, $/, '');
                    search_json[search_options['d_spacing']] = value_string;
                }
                else {
                    // Energy search...
                    let theta = items[6];
                    console.log('Theta: ', items[6]);
                    for(let i= 0; i < values.length; i++) {
                        let energy_low = parseFloat(values[0]) + parseFloat(tolerance);
                        console.log('Energy low: ', energy_low);
                        let energy_high = parseFloat(values[0]) - parseFloat(tolerance);
                        console.log('Energy high: ', energy_high);
                        let theta_radians = Math.PI * theta / 180;
                        console.log('Theta radians: ', theta_radians);

                        let d_low = 6.1993 / (Math.sin(theta_radians) * energy_low);
                        console.log('d_low: ', d_low);
                        let d_high = 6.1993 / (Math.sin(theta_radians) * energy_high);
                        console.log('d_high: ', d_high);

                        if(d_low > d_high) {
                            let tmp = d_low;
                            d_low = d_high;
                            d_high = tmp;
                        }
                        search_json[search_options['d_spacing']] += '>=' + Math.round((d_low) * 10000)/10000
                            + ' <=' + Math.round((d_high) * 10000)/10000;
                    }
                }
            }

            // Get chemistry excludes
            if ($("#txt_chemistry_excl").val() !== undefined) {
                // {"dt_id":"3","21":"!Ni"}
                // {"dt_id":"3","21":"!Ni,!O"}
                if (search_json[search_options['chemistry_incl']]) {
                    search_json[search_options['chemistry_incl']] += ' ';
                    $("#txt_chemistry_excl").val().split(/,/).forEach(
                        function (item) {
                            if (item.trim() !== '') {
                                search_json[search_options['chemistry_incl']] += '!' + item.trim() + ' ';
                            }
                        }
                    );
                } else {
                    $("#txt_chemistry_excl").val().split(/,/).forEach(
                        function (item) {
                            if (item.trim() !== '') {
                                search_json[search_options['chemistry_incl']] += '!' + item.trim() + ' ';
                            }
                        }
                    );
                }
            }

            /*
                $criteria['sort_by'] = array(
                          'sort_dir' => $sort_dir,
                          'sort_df_id' => $sort_df_id
                      );
             */

            // a, b, c, alpha, beta, gamma, sg, cs
            // Parse the search string
            // a='>=3 <=4' b='>=3 <=4' c='>=3 <=4' alpha='>=90 <=90' beta='>=90 <=90' gamma='>=90 <=90' SG=undefined CS=undefined
            // #txt_cell_parameters
            let txt_cell_parameters = $("#txt_cell_parameters").val();
            let cell_param_array = [];
            if (txt_cell_parameters.match(/,/)) {
                cell_param_array = txt_cell_parameters.split(/,/);
            } else {
                cell_param_array.push(txt_cell_parameters)
            }
            console.log('Cell parameters: ', cell_param_array);

            // Checking cell param array
            for (let i = 0; i < cell_param_array.length; i++) {
                // split on "=" and set parameter
                if (cell_param_array[i] !== '' && cell_param_array[i].match(/='/)) {
                    let param_data = cell_param_array[i].split(/='/);
                    param_data[1] = param_data[1].replace(/'/, '');
                    console.log('CELL PARAM: ' + param_data[0].trim() + ' ' + param_data[1])
                    search_json[search_options[param_data[0].trim()]] = param_data[1]
                }
            }

            // Get sort
            if (
                $('#sel_sort').find(':selected').val()
                && $('#sel_sort_dir').find(':selected').val()
            ) {
                search_json['sort_by'] = {};
                search_json['sort_by']['sort_df_id'] = $('#sel_sort').find(':selected').val();
                search_json['sort_by']['sort_dir'] = $('#sel_sort_dir').find(':selected').val();
            }
            console.log('Search JSON: ', search_json)

            // Encode to base 64 - atob()
            let search_string = b64EncodeUnicode(JSON.stringify(search_json)); // "JUUyJTlDJTkzJTIwJUMzJUEwJTIwbGElMjBtb2Rl"
            search_string = search_string.replace(/==$/, '');
            search_string = search_string.replace(/=$/, '');
            // https://beta.amcsd.net/odr/amcsd_samples#/odr/search/display/7/eyJkdF9pZCI6IjMifQ/1

            let search_template = search_options['default_search'];
            console.log("VAC: " + jQuery("#ViewingAMCLongForm").val());

            if(jQuery("#ViewingAMCShortForm").is(':checked')){
                console.log('Short form');
                search_template = search_options['amc_short_form'];
            }
            if(jQuery("#ViewingCIF").is(':checked')){
                console.log('CIF');
                search_template = search_options['cif'];
            }

            console.log('Search Template: ', search_template)
            // console.log('Search String: ', search_string)
            // if(confirm('Search it')) {
                let redirect = search_options['redirect_url'] + "/" + search_template + "/" + search_string + "/1";
                window.location = redirect, true
            // }
            return false;
        }

        function setInclExcl(obj) {
            // Check if element is "selected"
            if (!$(obj).hasClass('excluded') && !$(obj).hasClass('included')) {
                $(obj).addClass('included')
            } else if ($(obj).hasClass('included')) {
                $(obj).removeClass('included')
                $(obj).addClass('excluded')
            } else if ($(obj).hasClass('excluded')) {
                $(obj).removeClass('excluded')
            }
        }

        function setChemistryFields() {

            // Determine included and excluded
            let incl_val = ''
            let txt_incl_val = ''
            $(".included").each(
                function () {
                    let element = $(this).attr('id').replace('periodic_table_', '');
                    if (
                        element !== "lanthanides"
                        && element !== "actinides"
                    ) {
                        if (incl_val !== '') {
                            incl_val += ", "
                        }
                        incl_val += element;
                    }
                    if (
                        !$(this).hasClass('pt_lanthanides')
                        && !$(this).hasClass('pt_actinides')
                    ) {
                        if (txt_incl_val !== '') {
                            txt_incl_val += ", "
                        }
                        txt_incl_val += element;
                    } else if (
                        $(this).hasClass('pt_lanthanides')
                        && !$("#periodic_table_lanthanides").hasClass('included')
                        && !$("#periodic_table_lanthanides").hasClass('excluded')
                    ) {
                        if (txt_incl_val !== '') {
                            txt_incl_val += ", "
                        }
                        txt_incl_val += element;
                    } else if (
                        $(this).hasClass('pt_actinides')
                        && !$("#periodic_table_actinides").hasClass('included')
                        && !$("#periodic_table_actinides").hasClass('excluded')
                    ) {
                        if (txt_incl_val !== '') {
                            txt_incl_val += ", "
                        }
                        txt_incl_val += element;
                    }
                }
            )
            $("#chemistry_incl_txt").val(incl_val)
            $("#txt_chemistry_incl").val(txt_incl_val)

            let excl_val = ''
            let txt_excl_val = ''
            $(".excluded").each(
                function () {
                    let element = $(this).attr('id').replace('periodic_table_', '');
                    if (
                        element !== "lanthanides"
                        && element !== "actinides"
                    ) {
                        if (excl_val !== '') {
                            excl_val += ", "
                        }
                        excl_val += element;
                    }
                    if (
                        !$(this).hasClass('pt_lanthanides')
                        && !$(this).hasClass('pt_actinides')
                    ) {
                        if (txt_excl_val !== '') {
                            txt_excl_val += ", "
                        }
                        txt_excl_val += element;
                    } else if (
                        $(this).hasClass('pt_lanthanides')
                        && !$("#periodic_table_lanthanides").hasClass('included')
                        && !$("#periodic_table_lanthanides").hasClass('excluded')
                    ) {
                        if (txt_excl_val !== '') {
                            txt_excl_val += ", "
                        }
                        txt_excl_val += element;
                    } else if (
                        $(this).hasClass('pt_actinides')
                        && !$("#periodic_table_actinides").hasClass('included')
                        && !$("#periodic_table_actinides").hasClass('excluded')
                    ) {
                        if (txt_excl_val !== '') {
                            txt_excl_val += ", "
                        }
                        txt_excl_val += element;
                    }
                }
            )
            $("#chemistry_excl_txt").val(excl_val)
            $("#txt_chemistry_excl").val(txt_excl_val)
        }
    });

})(jQuery);

function togglePeriodicTable() {
    jQuery('#AMCSDPeriodicTable').slideToggle('fast')
}

function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded Unicode,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
        }))
        .replace(/\+/g, '-')
        .replace(/\//g, '_')
        .replace(/=+$/, '');
}

/*
function b64EncodeUnicode(str) {
	return btoa(str)
		.replace(/\+/g, '-')
		.replace(/\//g, '_')
		.replace(/=+$/, '');
}

 */

function UnicodeDecodeB64(str) {
    return decodeURIComponent(
        atob(
            str.replace(/-/g, '+')
                .replace(/_/g, '/')
                .padEnd(value.length + (m === 0 ? 0 : 4 - m), '=')
        )
    );
}

function clearMineralNameList() {
    // Clear minerals_selected array
    minerals_selected = [];
    jQuery(".AMCSDMineralNameLetter").removeClass('AMCSDAlphaSelected');

    jQuery(".AMCSDMineralName").each(function () {
        jQuery(this).removeClass('AMCSDMineralNameSelected')
        jQuery("#txt_mineral").val('');
    })
}

function clearAuthorNameList() {
    // Clear authors_selected array
    authors_selected = [];
    jQuery(".AMCSDAuthorNameLetter").removeClass('AMCSDAlphaSelected');

    jQuery(".AMCSDAuthorName").each(function () {
        jQuery(this).removeClass('AMCSDAuthorNameSelected')
        jQuery("#txt_author").val('');
    })
}


function localeSort(array_obj) {
    array_obj.sort( (a,b) => {
        let nameA = a.toLowerCase().replace(/[\(\)\-\_]/g, '');
        let nameB = b.toLowerCase().replace(/[\(\)\-\_]/g, '');
        return nameA.localeCompare(nameB, 'en')
    });

    return array_obj;
}

/*
    Requires array_obj to be sorted...
 */
function hiLoSearch(search_string, array_obj) {
    // max 10 loops = 2^10
    let low = 0;
    let high = array_obj.length - 1;
    let mid = Math.floor((high-low)/2)
    for(let i= 0; i < 30; i++) {
        let value = array_obj[mid];
        if (search_string.localeCompare(value, 'en', {sensitivity: "base"}) === 0) {
            return value;
        }
        else if (search_string.localeCompare(value, 'en', {sensitivity: "base"}) < 0) {
            // Before
            high = mid
            mid = Math.floor(high - (high-low)/2)
        }
        else {
            // After
            low = mid
            mid = Math.floor(low + (high-low)/2)
        }
    }
    return null
}

function getUniqueValues(value, index, array) {
    return array.indexOf(value) === index;
}


