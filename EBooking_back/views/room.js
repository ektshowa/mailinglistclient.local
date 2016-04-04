var $ = require('jquery');
var Backbone = require('backbone');
//var _ = require('underscore');
var RoomView = Backbone.View.extend({
	tagName: 'article',
	className: 'room',
	template: _.template('<h1><%= roomNumber %><hr></h1>'),
	
	initialize: function() {
		this.listenTo(this.model, 'change:roomCategory', this.render);
	},
	render: function() {
		//this.$el.html(this.model.get('roomCategory'));
		this.$el.html(this.template(this.model.toJSON()));
		this.$el.toggleClass('selected', this.model.get('selected'));
		return this;
	}
});
module.exports = RoomView;
