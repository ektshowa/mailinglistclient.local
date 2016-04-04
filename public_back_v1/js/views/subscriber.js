var mailingListApp = mailingListApp || {};

mailingListApp.SubscriberLoginView = Backbone.View.extend({
	//el: '#loginSubscriber',
	el: '#subscriberLoginForm',
	
	initialize: function() {
		//this.model = new mailingListApp.SubscriberModel();
		//console.log('the model:' + this.model.email);
		console.log('Subscriber Login View has been created');
	},
	
	events: {
		"click #loginButton": "submitLoginCredentials"
	},
	
	submitLoginCredentials: function( e ) {
		e.preventDefault();
		console.log('Subscriber getting in submit event handler');
		var data = this.$el.serializeObject();
		console.log(data);
        //this.model.set(data);
        this.model = new mailingListApp.SubscriberModel(data);
        console.log("MODEL FETCH EMAIL " + this.model.attributes.email + "MODEL CID " + this.model.cid);
        this.model.fetch({
        	    wait: true,
				success: function(model, response, options) {
					//console.log("Found Subscriber: " + response.get("firstname") + " " + response.get("lastname"));
				}
	    });
	}
});

$(function () {
    var view = new mailingListApp.SubscriberLoginView({
        //el: '#loginSubscriber',
        //el: '#subscriberLoginForm'
    });
});
