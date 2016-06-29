var express = require('express');
var router = express.Router();

var db = require('../queries/queries.js');
var jq = require('../queries/jq.js');


router.get('/', function(req, res, next) {
	db.countryList(function(result){
		db.selectProgressState(function(progressState){
			res.render('index', { 
							countries: result,
							state: progressState
						});	
		})
		
	});
});



module.exports = router;

