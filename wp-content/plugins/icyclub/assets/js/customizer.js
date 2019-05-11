/* Customizer live prview js for homepage section */
( function( $ ) {

	
	//Slider title
	wp.customize(
		'slider_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.slide-caption div h1' ).text( newval );
				}
			);
		}
	);
	
	//Slider description
	wp.customize(
		'slider_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.slide-caption div p' ).text( newval );
				}
			);
		}
	);
	
	//Slider button
	wp.customize(
		'slider_btn_txt', function( value ) {
			value.bind(
				function( newval ) {
					$( '.slide-caption div a' ).text( newval );
				}
			);
		}
	);
	
	// Service Heading
	wp.customize(
		'service_section_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.consultup-service-section .consultup-heading h3' ).text( newval );
				}
			);
		}
	);

	// Service Description
	wp.customize(
		'service_section_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.consultup-service-section .consultup-heading p' ).text( newval );
				}
			);
		}
	);
	
	// Service one title
	wp.customize(
		'service_one_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-one h3' ).text( newval );
				}
			);
		}
	);
	
	// Service one description
	wp.customize(
		'service_one_description', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-one .ta-service.three p' ).text( newval );
				}
			);
		}
	);
	
	// Service one btn
	wp.customize(
		'ser_one_btn_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-one a' ).text( newval );
				}
			);
		}
	);
	
	// Service two icon
	wp.customize(
		'service_two_icon', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-two i' ).text( newval );
				}
			);
		}
	);
	
	// Service two title
	wp.customize(
		'service_two_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-two h3' ).text( newval );
				}
			);
		}
	);
	
	// Service two description
	wp.customize(
		'service_two_description', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-two .ta-service.three p' ).text( newval );
				}
			);
		}
	);
	
	// Service two btn
	wp.customize(
		'ser_one_btn_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-one a' ).text( newval );
				}
			);
		}
	);
	
	
	// Service three icon
	wp.customize(
		'service_three_icon', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-three i' ).text( newval );
				}
			);
		}
	);
	
	// Service three title
	wp.customize(
		'service_three_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-three h3' ).text( newval );
				}
			);
		}
	);
	
	// Service three description
	wp.customize(
		'service_three_description', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-three .ta-service.three p' ).text( newval );
				}
			);
		}
	);
	
	// Service three btn
	wp.customize(
		'ser_three_btn_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-one a' ).text( newval );
				}
			);
		}
	);
	
	// Callout title
	wp.customize(
		'callout_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.consultup-callout p' ).text( newval );
				}
			);
		}
	);
	
	//Callout description
	wp.customize(
		'callout_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.consultup-callout .consultup-callout-inner h3' ).text( newval );
				}
			);
		}
	);
	
	//Callout btn text
	wp.customize(
		'callout_btn_txt', function( value ) {
			value.bind(
				function( newval ) {
					$( '.consultup-callout a' ).text( newval );
				}
			);
		}
	);
	
	
	// Portfolio Heading
	wp.customize(
		'portfolio_section_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.consultup-portfolio .consultup-heading h3' ).text( newval );
				}
			);
		}
	);

	// Portfolio Description
	wp.customize(
		'portfolio_section_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.consultup-portfolio .consultup-heading p' ).text( newval );
				}
			);
		}
	);
	
	
	// Portfolio one title
	wp.customize(
		'project_title_one', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-one h5' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio one description
	wp.customize(
		'project_desc_one', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-one .consultup-portfolio-block p' ).text( newval );
				}
			);
		}
	);
	
	
	// Portfolio two title
	wp.customize(
		'project_title_two', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-two h5' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio two description
	wp.customize(
		'project_desc_two', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-two .consultup-portfolio-block p' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three image
	wp.customize(
		'project_image_three', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port3 .post-thumbnail' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three title
	wp.customize(
		'project_title_three', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-three h5' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three description
	wp.customize(
		'project_desc_three', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-three .consultup-portfolio-block p' ).text( newval );
				}
			);
		}
	);
	
	
	// Testimonial background image
	wp.customize(
		'testimonial_callout_background', function( value ) {
			value.bind(
				function( newval ) {
					$( 'section.testimonial-section' ).text( newval );
				}
			);
		}
	);
	
	
	
	
	// Testimonial Heading
	wp.customize(
		'testimonial_section_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonials-section .consultup-heading h3' ).text( newval );
				}
			);
		}
	);

	// Testimonial Description
	wp.customize(
		'testimonial_section_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonials-section .consultup-heading p' ).text( newval );
				}
			);
		}
	);
	
	// Testimonial one title
	wp.customize(
		'testimonial_one_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-one .testimonials_qute .sub-qute h5' ).text( newval );
				}
			);
		}
	);
	
	// Testimonial one description
	wp.customize(
		'testimonial_one_desc', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-one .testimonials_qute .sub-qute p' ).text( newval );
				}
			);
		}
	);
	
	// Testimonial one name
	wp.customize(
		'testimonial_one_name', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-one .testimonials_qute .consultup-client-info h6' ).text( newval );
				}
			);
		}
	);
	
	// testimonal one designation
	wp.customize(
		'testimonial_one_designation', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-one .consultup-client-info p' ).text( newval );
				}
			);
		}
	);
	
	
	// testimonal one title
	wp.customize(
		'testimonial_two_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-two .testimonials_qute .sub-qute h5' ).text( newval );
				}
			);
		}
	);

	// testimonal one description
	wp.customize(
		'testimonial_two_desc', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-two .testimonials_qute .sub-qute p' ).text( newval );
				}
			);
		}
	);
	
	// testimonal name
	wp.customize(
		'testimonial_two_name', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-two .testimonials_qute .consultup-client-info h6' ).text( newval );
				}
			);
		}
	);
	
	// testimonal designation
	wp.customize(
		'testimonial_two_designation', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-two .consultup-client-info p' ).text( newval );
				}
			);
		}
	);
	
} )( jQuery );