var express = require('express');
var router = express.Router();

var db = require('../queries/queries.js');
//var loginCheck = require('../queries/checkLogin.js');



router.get('/', function(req, res, next) {
	var fullUrl = req.protocol + '://' + req.get('host') + req.originalUrl;
	if(!req.session.username){res.render('login', {fullUrl : fullUrl})}else{
		db.countryList(function(result){
			db.selectProgressState(function(progressState){
				res.render('index', { 
								countries: result,
								state: progressState,
								user: req.session.username
							});	
			})
			
		});
	}
});



module.exports = router;

