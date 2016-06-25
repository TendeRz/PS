var express = require('express');
var router = express.Router();
var db = require('../queries/queries.js');

/* GET users listing. */
router.get('/', function(req, res, next) {
	var selected = req.query.set;
	
	db.setCountries(selected, function(result){
			res.send(result);		
	})
});

	module.exports = router;
