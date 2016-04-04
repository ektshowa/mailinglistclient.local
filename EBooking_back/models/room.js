var Backbone = require('backbone');
var Room = Backbone.Model.extend({
	defaults: {
		id:0,
		roomCategory: "empty",
		roomNumber: 0,
		price: 0,
		NumberOfBeds: 0,
		bedType: "empty",
		description: "empty",
		selected: false
	}
});
module.exports = Room;
