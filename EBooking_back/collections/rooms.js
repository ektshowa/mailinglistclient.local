var Backbone = require("backbone");
var Room = require('models/room');
var Rooms = Backbone.Collection.extend({
	model: Room,
	
	// Unselect all models
	resetSelected: function() {
		this.each(function(model) {
			model.set({"selected": false});
		});
	},
	
	// Select a specific model from the collection
	selectByID: function(id) {
		this.resetSelected();
		var room = this.get(id);
		room.set({"selected": true});
		return room.id;
	},
	
	sortByHotelName: function() {
		return this.sortBy('hotelName');
	} 
});
module.exports = Rooms;
