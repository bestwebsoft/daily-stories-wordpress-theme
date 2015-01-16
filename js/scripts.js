( function( $ ) {
    // Inside of this function, $() will work as an alias for jQuery()
    // and other libraries also using $ will not be accessible under this shortcut
	$( document ).ready( function() {
		/*refresh all forms*/
		$( 'input:checked' ).removeAttr( 'checked' );
		$( 'input:file' ).val( '' );
		/*work with form elements*/
		/*radiobuttons restyle*/
		$( 'input[type=radio]' ).wrap( '<div class="dlstrs-radio"></div>' );
		/*hover realization*/
		$( '.dlstrs-radio' ).mouseenter( function() {
			$( this ).addClass( 'dlstrs-hover' );
		} );
		$( '.dlstrs-radio' ).mouseleave( function() {
			$( this ).removeClass( 'dlstrs-hover' );
		} );
		/*active realization*/
		$( '.dlstrs-radio' ).click( function() {
			var current_name = $( this ).find( 'input' ).attr( 'name' );
			if ( $( this ).find( 'input' ).is( 'checked' ) ) {
			}
			else {
				$( this ).closest( 'form' ).find( 'input[type=radio]' ).each( function() {
					if ( $( this ).attr( 'name' ) == current_name ) {
						$( this ).removeAttr( 'checked' );
						$( this ).parent().removeClass( 'dlstrs-active' );
					}
				} );
				$( this ).addClass( 'dlstrs-active' );
				$( this ).find( 'input' ).attr( 'checked', true );
			}
		} );
		/*checkboxes restyle*/
		$( 'input[type=checkbox]' ).wrap( '<div class="dlstrs-check"></div>' );
		/*hover realization*/
		$( '.dlstrs-check' ).mouseenter( function() {
			$( this ).addClass( 'dlstrs-hover' );
		} );
		$( '.dlstrs-check' ).mouseleave( function() {
			$( this ).removeClass( 'dlstrs-hover' );
		} );		
		/*active Realization*/
		$( '.dlstrs-check' ).find( 'input[type=checkbox]' ).attr( ':checked', false );
		$( '.dlstrs-check' ).click( function() {
			if ( $( this ).find( 'input' ).is( ':checked', true ) ) {
				$( this ).removeClass( 'dlstrs-active' );
			}
			else {
				$( this ).addClass( 'dlstrs-active' );
				$( this ).find( 'input' ).attr( ':checked', true );
			}
		} );
		/*reset button restyle*/
		$( 'input:reset' ).click( function() {
			/*reset checkboxes and radio*/
			$( this ).closest( 'form' ).find( 'input' ).each( function() {
				$( this ).removeAttr( 'checked' );
			} );
			$( this ).closest( 'form' ).find( '.dlstrs-option' ).removeClass( 'dlstrs-option-selected' );
			$( this ).closest( 'form' ).find( '.dlstrs-radio' ).removeClass( 'dlstrs-active' );
			$( this ).closest( 'form' ).find( '.dlstrs-check' ).removeClass( 'dlstrs-active' );
			/*reset input:file*/
			$( this ).closest( 'form' ).find( '.dlstrs-custom-file-text' ).text( script_loc.choose_file );
			$( this ).closest( 'form' ).find( '.dlstrs-custom-file-status' ).text( script_loc.file_is_not_selected );
		} );
		/*select section restyle*/
		var test = $( 'select' ).size();
		for ( var k = 0; k < test; k++ ) {
			$( 'select' ).eq( k ).css( 'display', 'none' );
			$( 'select' ).eq( k ).after( CreateSelect( k ) );
		}
		/*functional of new select*/
		$( '.dlstrs-select' ).click( function() {
			if ( $( this ).find( '.dlstrs-options' ).css( 'display' ) == 'none' ) {
				$( this ).css( 'z-index', '100' );
				$( this ).find( '.dlstrs-options' ).css( {
					'display': 'block'
				} );
			} 
			else {
				$( this ).css( 'z-index', '10' );
				$( this ).find( '.dlstrs-options' ).css( {
					'display': 'none'
				} );
			}
		} );
		$( '.dlstrs-select' ).find( '.dlstrs-option' ).click( function() {
			$( this ).closest( '.dlstrs-select' ).find( '.dlstrs-option' ).removeClass( 'dlstrs-option-selected' );
			$( this ).addClass( 'dlstrs-option-selected' );
			/*write text to active opt*/
			$( this ).parent().parent().find( '.dlstrs-active-opt' ).find( 'div:first' ).text( $( this ).text() );
			/*remove active option from init select*/
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).removeAttr( 'selected' );
			/*add atrr selected to select*/
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).eq( ( $( this ).attr( 'name' ) ) ).attr( 'selected', 'selected' );
		} );
		/*input:file restyle*/
		$( createInputAttr() );
		/*functional of new input:file*/
		$( '.dlstrs-custom-file' ).click( function() {
			var file_input = document.getElementById( $( this ).find( '.dlstrs-custom-file-status' ).attr( 'name' ) )
			$( file_input ).click();
		} );
		$( 'input:file' ).change( function() {
			var val = $(this).attr( 'id' );
			$( '[name='+val+']' ).text( $( this ).val().split( '\\' ).pop() )
		} );
		/*archive-dropdown widget functional*/
		$( '[name=archive-dropdown]' ).next( '.dlstrs-select' ).find( '.dlstrs-option' ).click( function() {
			if ( $( this ).attr( 'value' ) ) {
				location.href = $( this ).attr( 'value' );
			}
		} );
		/*category-dropdown widget functional*/
		$( '[name=cat]' ).next( '.dlstrs-select' ).find( '.dlstrs-option' ).click( function() {
			if ( $( this ).attr( 'value' ) > 0 ) {
				location.href = script_loc.dlstrs_home_url + '?cat=' + $( this ).attr( 'value' );
			}
		} );
		var dlstrs_container_header = $( '.dlstrs-container-header' ),
			timeout = false;
		$.fn.smallMenu = function() {
			dlstrs_container_header.find( '.dlstrs-site-navigation' ).removeClass( 'main-navigation' ).addClass( 'main-small-navigation' );
			dlstrs_container_header.find( '.dlstrs-site-navigation button' ).removeClass( 'dlstrs-assistive-text' ).addClass( 'menu-toggle' );
			$( '.menu-toggle' ).unbind( 'click' ).click( function() {
				dlstrs_container_header.find( '.menu' ).toggle();
				$( this ).toggleClass( 'toggled-on' );
			} );
		};
		// Check viewport width on first load.
		if ( $( window ).width() <= 780 )
			$.fn.smallMenu();
		// Check viewport width when user resizes the browser window.
		$( window ).resize( function() {
			var browserWidth = $( window ).width();
			if ( false !== timeout )
				clearTimeout( timeout );
			timeout = setTimeout( function() {
				if ( browserWidth <= 780 ) {
					$.fn.smallMenu();
				} else {
					dlstrs_container_header.find( '.dlstrs-site-navigation' ).removeClass( 'main-small-navigation' ).addClass( 'main-navigation' );
					dlstrs_container_header.find( '.dlstrs-site-navigation button' ).removeClass( 'menu-toggle' ).addClass( 'dlstrs-assistive-text' );
					dlstrs_container_header.find( '.menu' ).removeAttr( 'style' );
				}
			}, 200 );
		} );			
	} );
} )( jQuery );

/* define all custom functions */
/*function for input:file*/
function CreateFileInput( k ) {
	var custom_file = document.createElement( 'div' );
	( function( $ ) {
		$( custom_file ).addClass( 'dlstrs-custom-file' );
		$( custom_file ).append( '<div class="dlstrs-custom-file-content"></div>' );
		$( custom_file ).find( '.dlstrs-custom-file-content' ).append( '<div class="dlstrs-custom-file-text"></div>' );
		$( custom_file ).find( '.dlstrs-custom-file-content' ).append( '<div class="dlstrs-custom-file-button"></div>' );
		$( custom_file ).append( '<div class="dlstrs-custom-file-status"></div>' );
		$( custom_file ).find('.dlstrs-custom-file-status').attr( 'name', $( 'input:file' ).eq(k).attr( 'id' ) )
		$( custom_file ).find( '.dlstrs-custom-file-text' ).text( script_loc.choose_file );
		$( custom_file ).find( '.dlstrs-custom-file-status' ).text( script_loc.file_is_not_selected );
		$( custom_file ).append( '<div class="clear"></div>' );
	} )( jQuery );
	return custom_file;
}
/*function for hide init input:file and add after a new input:file*/
function createInputAttr() {
	( function( $ ) {
		var size = $( 'input:file' ).size();
		for ( var i = 0; i < size; i++ ) {
			$( 'input:file' ).eq(i).attr( 'id', 'file-' + i ).css( 'display', 'none' ).after( CreateFileInput( i ) );
		};
	} )( jQuery );
}
/*function for custom select*/
function CreateSelect( k ) {
	/*create select division*/
	var sel = document.createElement( 'div' );
	( function( $ ) {
		$( sel ).addClass( 'dlstrs-select' );
		/*create active-option division*/
		var active_opt = document.createElement( 'div' );
		$( active_opt ).addClass( 'dlstrs-active-opt' );
		$( active_opt ).append( '<div></div>' );
		$( active_opt ).append( '<div class="dlstrs-select-button"></div>' );
		$( active_opt ).find( 'div:first' ).text( $( 'select' ).eq( k ).find( 'option' ).first().text() );
		/*create options division*/
		var option_array = document.createElement( 'div' );
		$( option_array ).addClass( 'dlstrs-options' );
		/*create array of optgroups*/
		var count = $( 'select' ).eq( k ).find( 'optgroup' ).size();
		var optgroups = [];
		/*create options division*/
		if ( count ) {
			var z = 0;
			for ( var i = 0; i < count; i++ ) {
				optgroups[i] = document.createElement( 'div' );
				$( optgroups[i] ).addClass( 'dlstrs-optgroup' );
				$( optgroups[i] )
					.text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).attr( 'label' ) );
			};
			for ( var i = 0; i < count; i++ ) {
				$( option_array ).append( optgroups[i] );
				for ( var j = 0; j < $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().size(); j++ ) {
					var opt = document.createElement( 'div' );
					$( opt ).addClass( 'dlstrs-option' );
					$( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).attr( 'value' ) );
					$( opt ).text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).text() );
					$( opt ).attr( 'name', z );
					z++;
					$( option_array ).append( opt );
				};
			};
		} 
		else {
			for ( var i = 0; i < $( 'select' ).eq( k ).find( 'option' ).size(); i++ ) {
				var opt = document.createElement( 'div' );
				$( opt ).addClass( 'dlstrs-option' );
				$( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'option' ).eq( i ).attr( 'value' ) );
				$( opt ).attr( 'name', i );
				$( opt ).text( $( 'select' ).eq( k ).find( 'option' ).eq( i ).text() );
				$( option_array ).append( opt );
			};
		};
		$( sel ).append( active_opt );
		$( sel ).append( option_array );
	} )( jQuery );
	return sel;
}