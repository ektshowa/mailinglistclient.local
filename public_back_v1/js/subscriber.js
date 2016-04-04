(function($) {
	var SubscriberModel = Backbone.Model.extend({
		defaults: {
			email: "mysub@google.com",
		},
		initialize: function() {
			console.log('Subscriber created ...');
		},
	//	urlRoot: ""
	    getModelUrl: function(method) {
	    	switch(method) {
	    		case 'read':
	    		    var queryParams = "email=thefirstmysub@google.com&" + "action=subscriberlogin";
	    		    return "http://mailinglistmanager.local?" + queryParams;
	    		    break;
	    		case 'create':
	    		    return '';
	    		    break;
	    	}
	    },
	    sync: function(method, model, options) {
	    	options || (options = {});
	    	options.url = this.getModelUrl(method.toLowerCase());
	    	
	    	return Backbone.sync.apply(this, arguments);
	    }
	}); 
	
	var SubscriberLoginView = Backbone.View.extend({
		el: '#loginSubscriber',
		editSubscriberTemplate: _.template($("#subscriberLoginTemplate").html()), 
				
		initialize: function() {
			this.model = new SubscriberModel({email: "mysub@google.com"});
			console.log('the model:' + this.model.email);
			console.log('Subscriber Login View has been created');
		},
		
		events: {
			"click #loginButton": "submitLoginCredentials"
		},
		
		loginSubscriber: function(e) {
			e.preventDefault();
			
			this.model.fetch({
				wait: true,
				success: function(model, response, options) {
					console.log("Found Subscriber: " + response.get("firstname") + " " + response.get("lastname"));
				}
			});
		},
		
		editSubscriberLogin: function() {
			this.$el.html(this.editSubscriberTemplate(this.model.toJSON()));
		},
		
		submitLoginCredentials: function(e) {
			e.preventDefault();
			
			var loginFormData = {};
			$(e.target).closest("form").find(":input").not("button").each(function() {
				var el = $(this);
				loginFormData[el.attr("class")] = el.val();
				this.model.set(loginFormData);
				this.render();
				
			});
		}
		
	});
	var thesubview = new SubscriberLoginView();
}(jQuery));
