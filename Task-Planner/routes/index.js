var express = require('express');
var router = express.Router();

var db = require('../queries/queries.js');
var jq = require('../queries/jq.js');


router.get('/', function(req, res, next) {
	db.countryList(function(result){				
		res.render('index', { countries: result });
	});
});




module.exports = router;

