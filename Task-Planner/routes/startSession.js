var express = require('express');
var router = express.Router();
var db = require('../queries/queries.js');

/* GET users listing. */
router.get('/', function(req, res, next) {
	var username = req.query.username;
	var password = req.query.password;


	db.sessionStart(username, password, function(result){
		if(result == "Oki"){
			req.session.username = username;
			res.send("Success");
		}else{
			req.session.username = '';
			res.send("Failure");
		}
	})

});

	module.exports = router;
