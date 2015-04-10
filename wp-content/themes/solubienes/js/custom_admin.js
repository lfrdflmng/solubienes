jQuery(document).ready(function($) {

	function updateCitySelect() {
		var val = $('#acf-field-estado').val();
		var $cities = $('#acf-field-ciudad').find('option');

		$.each($cities, function(i,o) {
			var $o = $(o);
			if ($o.attr('value') == 'null') {
				return true;
			}
			if ($o.attr('value').split('_')[0] == val) {
				$o.show();
			}
			else {
				$o.hide();
			}
		});
	}

	$('#acf-field-estado').change(function() {
		$('#acf-field-ciudad').val('null');
		updateCitySelect();
	});

	updateCitySelect();
});