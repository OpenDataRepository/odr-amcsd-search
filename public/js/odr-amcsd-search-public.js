(function( $ ) {
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

	jQuery( window ).load(function() {

		// Check if there are loaded search values
		console.log('Hash: ' + location.hash)
		let hash_params = location.hash.split('/');

		// Check if hash is a search page and reveal search block
		if(location.hash.match(/odr\/search\/display/)) {
			$("#odr_amcsd_search_dialog").show('fast');
			summarySearchMode();
		}

		// Check if a search is appended
		if(
			hash_params[5] !== undefined
			&& hash_params[5].length > 0
		) {
			let search_query = UnicodeDecodeB64(hash_params[5])
			// let search_query = hash_params[5];
			console.log('Search Query: ', search_query)
			for (const [key, value] of Object.entries(JSON.parse(search_query))) {
				// console.log(`${key}: ${value}`);
				for (const [option, option_value] of Object.entries(search_options)) {
					if(option_value === key) {
						console.log('Found: ' + option)
						switch(option) {
							case 'general_search':
								$("#txt_general").val(value);
								$("#rsf_general_block").show();
								break;
							case 'chemistry_incl':
								// split on spaces
								let chemistry_arr = value.split(/\s+/);
								for(let i = 0; i < chemistry_arr.length; i++) {
									if(!chemistry_arr[i].match(/^!/)) {
										// Includes
										let val = $("#txt_chemistry_incl").val()
										val = val + ", " + chemistry_arr[i]
										val = val.replace(/^,\s/, '');
										val = val.replace(/,\s$/, '');
										$("#txt_chemistry_incl").val(val)
										$("#chemistry_incl_txt").val(val)
									}
									else {
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

		jQuery(".chemistry_lookup_link").click(
			function () {
				$("#div_periodic_table").slideToggle('300',
					function () {
						if ($("#div_periodic_table:visible") && $(window).width() < 600) {
							$('html, body').animate({
								scrollTop: ($("#div_periodic_table").offset().top - 110)
							}, 2000);
						}
					})
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


		/*
		jQuery("#amcsd-search-form-wrapper").submit(
			function () {
				submitSearchForm();
				return false;
			}
		);
		 */

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
		jQuery(".AMCSDMineralNameLetter").click(function() {
			selectMineralNames(jQuery(this).html())
		});

		selectMineralNames("A")

		jQuery(".AMCSDMineralName").click(function() {
			if(jQuery("#txt_mineral").val().length === 0) {
				jQuery("#txt_mineral").val(
					jQuery(this).html()
				)
			}
			else {
				jQuery("#txt_mineral").val(
					jQuery("#txt_mineral").val() + ', ' +
					jQuery(this).html()
				)
			}
			jQuery(this).addClass('AMCSDMineralNameSelected')
		});

		// Prepare Author Name Modal
		jQuery(".AMCSDAuthorNameLetter").click(function() {
			selectAuthorNames(jQuery(this).html())
		});

		selectAuthorNames("A")

		jQuery(".AMCSDAuthorName").click(function() {
			if(jQuery("#txt_author").val().length === 0) {
				jQuery("#txt_author").val(
					jQuery(this).html()
				)
			}
			else {
				jQuery("#txt_author").val(
					jQuery("#txt_author").val() + ', ' +
					jQuery(this).html()
				)
			}
			jQuery(this).addClass('AMCSDAuthorNameSelected')
		});


	});

	function selectMineralNames(letter) {
		let regex = new RegExp('^' + letter, 'i');
		jQuery(".AMCSDMineralName").each(function() {
			if(jQuery(this).html().match(regex)) {
				jQuery(this).removeClass('AMCSDMineralNameSelected')
				jQuery(this).show()
			}
			else {
				jQuery(this).hide()
			}
		})
	}

	function selectAuthorNames(letter) {
		let regex = new RegExp('^' + letter, 'i');
		jQuery(".AMCSDAuthorName").each(function() {
			if(jQuery(this).html().match(regex)) {
				jQuery(this).removeClass('AMCSDAuthorNameSelected')
				jQuery(this).show()
			}
			else {
				jQuery(this).hide()
			}
		})
	}

	function ResetForm() {
		console.log('RESET FORM')
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

	function submitAmcsdSearchForm() {
		console.log('Submit Search Form')
		// UnicodeDecodeB64("JUUyJTlDJTkzJTIwJUMzJUEwJTIwbGElMjBtb2Rl"); // "✓ à la mode"
		// Get mineral names or AMCSD IDS from txt_mineral
		let search_json = {
			"dt_id": search_options['datatype_id']
		};
		if($("#txt_mineral").val().trim().match(/^R\d+$/i)) {
			// display specific mineral id
			// {"dt_id":"3","34":"r040034"}
			search_json[ search_options['general_search'] ] = $("#txt_mineral").val().trim();
		}
		else if($("#txt_mineral").val().trim() !== '') {
			// Check for commas (separated minerals)
			// search for IMA Mineral Display Name
			// {"dt_id":"3","18":"actinolite"}
			search_json[ search_options['mineral_name'] ] = $("#txt_mineral").val().replaceAll(/,/g, ' ||').trim();
		}

		// Get General Text search field
		if($("#txt_general").val().trim() !== '') {
			// {"dt_id":"3","gen":"quartz"}
			search_json[ search_options['general_search'] ] = $("#txt_general").val().trim();
		}

		if($("#txt_author").val().trim() !== '') {
			// {"dt_id":"3","gen":"quartz"}
			search_json[ search_options['author_names'] ] = $("#txt_author").val().replaceAll(/,/g, ' ||').trim();
		}

		// Get chemistry includes
		if($("#txt_chemistry_incl").val() !== '') {
			// {"dt_id":"3","21":"C"}
			search_json[ search_options['chemistry_incl'] ] = $("#txt_chemistry_incl").val().trim().replaceAll(/,/g,' ');
		}


		// Get chemistry excludes
		if($("#txt_chemistry_excl").val() !== undefined) {
			// {"dt_id":"3","21":"!Ni"}
			// {"dt_id":"3","21":"!Ni,!O"}
			if(search_json[ search_options['chemistry_incl'] ]) {
				search_json[ search_options['chemistry_incl'] ] += ' ';
				$("#txt_chemistry_excl").val().split(/,/).forEach(
					function(item) {
						if(item.trim() !== '') {
							search_json[ search_options['chemistry_incl'] ] += '!' + item.trim() + ' ';
						}
					}
				);
			}
			else {
				$("#txt_chemistry_excl").val().split(/,/).forEach(
					function(item) {
						if(item.trim() !== '') {
							search_json[ search_options['chemistry_incl'] ] += '!' + item.trim() + ' ';
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
		if(txt_cell_parameters.match(/,/)) {
			cell_param_array = txt_cell_parameters.split(/,/);
		}
		else {
			cell_param_array.push(txt_cell_parameters)
		}

		for(let i=0; i<cell_param_array.length; i++) {
			// split on "=" and set parameter
			let param_data = cell_param_array[i].split(/='/);
			param_data[1] = param_data[1].replace(/'/,'');
			// console.log('CELL PARAM: ' + param_data[0].trim() + ' ' + param_data[1])
			search_json[ search_options[ param_data[0].trim() ] ] = param_data[1]
		}


		// Get sort
		if(
			$('#sel_sort').find(':selected').val()
			&& $('#sel_sort_dir').find(':selected').val()
		) {
			search_json['sort_by'] = { };
			search_json['sort_by']['sort_df_id'] = $('#sel_sort').find(':selected').val();
			search_json['sort_by']['sort_dir'] = $('#sel_sort_dir').find(':selected').val();
		}
		// console.log('Search JSON: ', search_json)

		// Encode to base 64 - atob()
	    let search_string = b64EncodeUnicode(JSON.stringify(search_json)); // "JUUyJTlDJTkzJTIwJUMzJUEwJTIwbGElMjBtb2Rl"
		search_string = search_string.replace(/==$/, '');
		search_string = search_string.replace(/=$/, '');
		// https://beta.amcsd.net/odr/amcsd_samples#/odr/search/display/7/eyJkdF9pZCI6IjMifQ/1


		// console.log('Search String: ', search_string)
		if(search_options['redirect_url'] === '/odr/network') {
			window.location = search_options['redirect_url'], true
		}
		else {
			let redirect =  search_options['redirect_url'] + "/" + search_options['default_search'] + "/" + search_string + "/1";
			window.location = redirect, true
		}
	}

	function setInclExcl(obj) {
		// Check if element is "selected"
		if(!$(obj).hasClass('excluded') && !$(obj).hasClass('included')) {
			$(obj).addClass('included')
		}
		else if($(obj).hasClass('included')) {
			$(obj).removeClass('included')
			$(obj).addClass('excluded')
		}
		else if($(obj).hasClass('excluded')) {
			$(obj).removeClass('excluded')
		}
	}

	function setChemistryFields() {

		// Determine included and excluded
		let incl_val = ''
		let txt_incl_val = ''
		$(".included").each(
			function() {
				let element = $(this).attr('id').replace('periodic_table_','');
				if(
					element !== "lanthanides"
					&& element !== "actinides"
				) {
					if(incl_val !== '') {
						incl_val += ", "
					}
					incl_val += element;
				}
				if(
					!$(this).hasClass('pt_lanthanides')
					&& !$(this).hasClass('pt_actinides')
				) {
					if (txt_incl_val !== '') {
						txt_incl_val += ", "
					}
					txt_incl_val += element;
				}
				else if(
					$(this).hasClass('pt_lanthanides')
					&& !$("#periodic_table_lanthanides").hasClass('included')
					&& !$("#periodic_table_lanthanides").hasClass('excluded')
				) {
					if (txt_incl_val !== '') {
						txt_incl_val += ", "
					}
					txt_incl_val += element;
				}
				else if(
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
			function() {
				let element = $(this).attr('id').replace('periodic_table_', '');
				if(
					element !== "lanthanides"
					&& element !== "actinides"
				) {
					if (excl_val !== '') {
						excl_val += ", "
					}
					excl_val += element;
				}
				if(
					!$(this).hasClass('pt_lanthanides')
					&& !$(this).hasClass('pt_actinides')
				) {
					if (txt_excl_val !== '') {
						txt_excl_val += ", "
					}
					txt_excl_val += element;
				}
				else if(
					$(this).hasClass('pt_lanthanides')
					&& !$("#periodic_table_lanthanides").hasClass('included')
					&& !$("#periodic_table_lanthanides").hasClass('excluded')
				) {
					if (txt_excl_val !== '') {
						txt_excl_val += ", "
					}
					txt_excl_val += element;
				}
				else if(
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

})( jQuery );

function togglePeriodicTable() {
	jQuery('#AMCSDPeriodicTableTD').toggle('slow')
}

function b64EncodeUnicode(str) {
	return btoa(str)
		.replace(/\+/g, '-')
		.replace(/\//g, '_')
		.replace(/=+$/, '');
}

function UnicodeDecodeB64(str) {
	return decodeURIComponent(
		atob(
			str.replace(/-/g, '+')
				.replace(/_/g, '/')
				.padEnd(value.length + (m === 0 ? 0 : 4 - m), '=')
			)
	);
}
