var ebooking = ebooking || {};

ebooking.RoomDetailsView = Backbone.View.extend({
	el: '#roomDetails',
	template: _.template('<%= roomCategory %> <br> <%= description %>'),
	render: function() {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	}
});
