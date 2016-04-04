var mailingListApp = mailingListApp || {};

mailingListApp.SubscriberModel = Backbone.Model.extend({
	defaults: {
		email: "",
		password: ""
	},
	initialize: function() {
			console.log('Subscriber created ...');
	},
	//	urlRoot: ""
	getModelUrl: function(method) {
	   	switch(method) {
	   		case 'read':
	   		    //var queryParams = "email=thefirstmysub@google.com&" + "action=subscriberlogin";
	   		    var queryParams = "email=" + this.attributes.email + "&password=" + this.attributes.password + "&service=LoginServices&action=loginSubscriber";
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
