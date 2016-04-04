var $ = Backbone.$;

var ebooking = ebooking || {};

var navbarhtml = $('#loginNavbar').html();
var navbartemplate = Handlebars.compile(navbarhtml);

ebooking.NavbarView = Backbone.View.extend({
	template: navbartemplate,
	
	
});
