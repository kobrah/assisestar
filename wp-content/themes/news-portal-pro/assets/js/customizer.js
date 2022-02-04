/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Header text color.
	wp.customize( 'np_site_title_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a, .site-description' ).css( {
				'color': to
			} );
		} );
	} );

	/* === body font === */
	wp.customize( 'p_font_family', function( value ) {
		value.bind( function( to ) {
			if(to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ){
				WebFont.load({ google: { families: [to] } });
			}
			$( 'body' ).css( 'font-family', to );
		});
	});
	wp.customize( 'p_font_style', function( value ) {
		value.bind( function( to ) {
				var weight = to.replace(/\D/g,'');
				var style = to.replace(/\d+/g, '');
				$( 'body' ).css( 'font-weight', weight );
				$( 'body' ).css( 'font-style', style );
		});
	});
	wp.customize( 'p_text_transform', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'text-transform', to );
		});
	});
	wp.customize( 'p_text_decoration', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'text-decoration', to );
		});
	});
	wp.customize( 'p_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'font-size', to+'px' );
		});
	});
	wp.customize( 'p_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'line-height', to );
		});
	});
	wp.customize( 'p_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'color', to );
		});
	});

	/* === h1 font === */
	wp.customize( 'h1_font_family', function( value ) {
		value.bind( function( to ) {
			if(to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ){
				WebFont.load({ google: { families: [to] } });
			}
			$( 'h1' ).css( 'font-family', to );
		});
	});
	wp.customize( 'h1_font_style', function( value ) {
		value.bind( function( to ) {
				var weight = to.replace(/\D/g,'');
				var style = to.replace(/\d+/g, '');
				$( 'h1' ).css( 'font-weight', weight );
				$( 'h1' ).css( 'font-style', style );
		});
	});
	wp.customize( 'h1_text_transform', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'text-transform', to );
		});
	});
	wp.customize( 'h1_text_decoration', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'text-decoration', to );
		});
	});
	wp.customize( 'h1_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'font-size', to+'px' );
		});
	});
	wp.customize( 'h1_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'line-height', to );
		});
	});
	wp.customize( 'h1_color', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'color', to );
		});
	});

	/* === h2 font === */
	wp.customize( 'h2_font_family', function( value ) {
		value.bind( function( to ) {
			if(to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ){
				WebFont.load({ google: { families: [to] } });
			}
			$( 'h2' ).css( 'font-family', to );
		});
	});
	wp.customize( 'h2_font_style', function( value ) {
		value.bind( function( to ) {
				var weight = to.replace(/\D/g,'');
				var style = to.replace(/\d+/g, '');
				$( 'h2' ).css( 'font-weight', weight );
				$( 'h2' ).css( 'font-style', style );
		});
	});
	wp.customize( 'h2_text_transform', function( value ) {
		value.bind( function( to ) {
			$( 'h2' ).css( 'text-transform', to );
		});
	});
	wp.customize( 'h2_text_decoration', function( value ) {
		value.bind( function( to ) {
			$( 'h2' ).css( 'text-decoration', to );
		});
	});
	wp.customize( 'h2_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'h2' ).css( 'font-size', to+'px' );
		});
	});
	wp.customize( 'h2_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'h2' ).css( 'line-height', to );
		});
	});
	wp.customize( 'h2_color', function( value ) {
		value.bind( function( to ) {
			$( 'h2' ).css( 'color', to );
		});
	});

	/* === h3 font === */
	wp.customize( 'h3_font_family', function( value ) {
		value.bind( function( to ) {
			if(to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ){
				WebFont.load({ google: { families: [to] } });
			}
			$( 'h3 a' ).css( 'font-family', to );
		});
	});
	wp.customize( 'h3_font_style', function( value ) {
		value.bind( function( to ) {
				var weight = to.replace(/\D/g,'');
				var style = to.replace(/\d+/g, '');
				$( 'h3 a' ).css( 'font-weight', weight );
				$( 'h3 a' ).css( 'font-style', style );
		});
	});
	wp.customize( 'h3_text_transform', function( value ) {
		value.bind( function( to ) {
			$( 'h3 a' ).css( 'text-transform', to );
		});
	});
	wp.customize( 'h3_text_decoration', function( value ) {
		value.bind( function( to ) {
			$( 'h3 a' ).css( 'text-decoration', to );
		});
	});
	wp.customize( 'h3_font_size', function( value ) {
		value.bind( function( to ) {
			var smallToSize = to-3;
			$( 'h3.large-size a' ).css( 'font-size', to + 'px' );
			$( 'h3.small-size a' ).css( 'font-size', smallToSize + 'px' );
		});
	});
	wp.customize( 'h3_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'h3 a' ).css( 'line-height', to );
		});
	});
	wp.customize( 'h3_color', function( value ) {
		value.bind( function( to ) {
			$( 'h3 a' ).css( 'color', to );
		});
	});

	/* === h4 font === */
	wp.customize( 'h4_font_family', function( value ) {
		value.bind( function( to ) {
			if(to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ){
				WebFont.load({ google: { families: [to] } });
			}
			$( 'h4' ).css( 'font-family', to );
		});
	});
	wp.customize( 'h4_font_style', function( value ) {
		value.bind( function( to ) {
				var weight = to.replace(/\D/g,'');
				var style = to.replace(/\d+/g, '');
				$( 'h4' ).css( 'font-weight', weight );
				$( 'h4' ).css( 'font-style', style );
		});
	});
	wp.customize( 'h4_text_transform', function( value ) {
		value.bind( function( to ) {
			$( 'h4' ).css( 'text-transform', to );
		});
	});
	wp.customize( 'h4_text_decoration', function( value ) {
		value.bind( function( to ) {
			$( 'h4' ).css( 'text-decoration', to );
		});
	});	
	wp.customize( 'h4_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'h4' ).css( 'font-size', to+'px' );
		});
	});
	wp.customize( 'h4_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'h4' ).css( 'line-height', to );
		});
	});
	wp.customize( 'h4_color', function( value ) {
		value.bind( function( to ) {
			$( 'h4' ).css( 'color', to );
		});
	});

	/* === h5 font === */
	wp.customize( 'h5_font_family', function( value ) {
		value.bind( function( to ) {
			if(to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ){
				WebFont.load({ google: { families: [to] } });
			}
			$( 'h5' ).css( 'font-family', to );
		});
	});
	wp.customize( 'h5_font_style', function( value ) {
		value.bind( function( to ) {
				var weight = to.replace(/\D/g,'');
				var style = to.replace(/\d+/g, '');
				$( 'h5' ).css( 'font-weight', weight );
				$( 'h5' ).css( 'font-style', style );
		});
	});
	wp.customize( 'h5_text_transform', function( value ) {
		value.bind( function( to ) {
			$( 'h5' ).css( 'text-transform', to );
		});
	});
	wp.customize( 'h5_text_decoration', function( value ) {
		value.bind( function( to ) {
			$( 'h5' ).css( 'text-decoration', to );
		});
	});
	wp.customize( 'h5_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'h5' ).css( 'font-size', to+'px' );
		});
	});
	wp.customize( 'h5_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'h5' ).css( 'line-height', to );
		});
	});
	wp.customize( 'h5_color', function( value ) {
		value.bind( function( to ) {
			$( 'h5' ).css( 'color', to );
		});
	});

	/* === h6 font === */
	wp.customize( 'h6_font_family', function( value ) {
		value.bind( function( to ) {
			if(to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ){
				WebFont.load({ google: { families: [to] } });
			}
			$( 'h6' ).css( 'font-family', to );
		});
	});
	wp.customize( 'h6_font_style', function( value ) {
		value.bind( function( to ) {
				var weight = to.replace(/\D/g,'');
				var style = to.replace(/\d+/g, '');
				$( 'h6' ).css( 'font-weight', weight );
				$( 'h6' ).css( 'font-style', style );
		});
	});
	wp.customize( 'h6_text_transform', function( value ) {
		value.bind( function( to ) {
			$( 'h6' ).css( 'text-transform', to );
		});
	});
	wp.customize( 'h6_text_decoration', function( value ) {
		value.bind( function( to ) {
			$( 'h6' ).css( 'text-decoration', to );
		});
	});
	wp.customize( 'h6_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'h6' ).css( 'font-size', to+'px' );
		});
	});
	wp.customize( 'h6_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'h6' ).css( 'line-height', to );
		});
	});
	wp.customize( 'h6_color', function( value ) {
		value.bind( function( to ) {
			$( 'h6' ).css( 'color', to );
		});
	});
	
} )( jQuery );
