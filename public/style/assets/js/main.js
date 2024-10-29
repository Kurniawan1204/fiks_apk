$.noConflict();

jQuery(document).ready(function($) {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	} );

	jQuery('.selectpicker').selectpicker;

	$('#menuToggle').on('click', function() {
		// Toggle the chevron icon between left and right
		$(this).find('i').toggleClass('fa-chevron-left fa-chevron-right');
		
		// Toggle the sidebar visibility
		$('#left-panel').toggleClass('collapsed');

		// Optional: Adjust right panel or content panel width if needed
		$('#right-panel').toggleClass('expanded');
	});

	$('#menuToggle').on('click', function(event) {
		$('body').toggleClass('open');
	});

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	function updateNavbarCounts() {
		fetch('/get-status-counts') // Panggil route PHP untuk mendapatkan data
			.then(response => response.json())
			.then(data => {
				// Update navbar dengan data yang diterima
				document.getElementById('permohonanCount').textContent = data.permohonan;
				document.getElementById('bayarCount').textContent = data.bayar;
			});
	}
	
	// Panggil updateNavbarCounts() setelah data diubah (gunakan AJAX atau JavaScript events)
	// Contoh: setelah menambahkan atau mengubah data pada tabel, panggil:
	updateNavbarCounts();
	// $('.user-area> a').on('click', function(event) {
	// 	event.preventDefault();
	// 	event.stopPropagation();
	// 	$('.user-menu').parent().removeClass('open');
	// 	$('.user-menu').parent().toggleClass('open');
	// });
	
	
	$('#validasi-select').on('change', function() {
		var value = $(this).val();
		if (value == 'Validasi') {
			// Lakukan aksi ketika memilih validasi
			// Contoh: menambahkan class active pada tab validasi
			$('#tab-validasi').addClass('active');
		} else {
			// Lakukan aksi ketika tidak memilih validasi
			// Contoh: menghapus class active pada tab validasi
			$('#tab-validasi').removeClass('active');
		}
	});
	
	
$(document).ready(function() {
		$('#bootstrap-data-table-export').DataTable();
	  } );
});
