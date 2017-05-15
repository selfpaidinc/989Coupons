$(document).ready(function(){
	if( $('.marquee-blck').length )
	{
		var cur = 0,
			arr = [];
		$(".marquee-blck .marquee-child").each(function() {
			arr.push( $(this).text() );
		});
		arr.push( $('.marquee').text() );
		setInterval(function() {
			if( typeof arr[ cur ] == 'undefined' ) {
				cur = 0;
			}
			$('.marquee').animate({'opacity': 0}, 1000, function () {
				$(this).text( arr[ cur ] );
				cur++;
			}).animate({'opacity': 1}, 1000);
			
		}, $(".marquee-blck").data('seconds') * 1000);
	}
});
$(function () {
    $('.input-group-addon.beautiful').each(function () {
        var $widget = $(this),
            $input = $widget.find('input'),
            type = $input.attr('type');
            settings = {
                checkbox: {
                    on: { icon: 'fa fa-check-circle-o' },
                    off: { icon: 'fa fa-circle-o' }
                },
                radio: {
                    on: { icon: 'fa fa-dot-circle-o' },
                    off: { icon: 'fa fa-circle-o' }
                }
            };
        $widget.prepend('<span class="' + settings[type].off.icon + '  fa-2x fa-fw"></span>');
        $widget.on('click', function () {
            $input.prop('checked', !$input.is(':checked'));
            updateDisplay();
        });
        function updateDisplay() {
            var isChecked = $input.is(':checked') ? 'on' : 'off';    
            $widget.find('.fa').attr('class', settings[type][isChecked].icon+'  fa-2x fa-fw');
            isChecked = $input.is(':checked') ? lang_remember : lang_do_not_remember;
            $widget.closest('.input-group').find('input[type="text"]').val(isChecked)
        }
        updateDisplay();
    });
});