( function( api ) {

	// Extends our custom "belleza" section.
	api.sectionConstructor['belleza'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );