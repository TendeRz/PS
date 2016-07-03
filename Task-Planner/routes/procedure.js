var express = require('express');
var router = express.Router();

var db = require('../queries/queries.js');

router.get('/', function(req, res, next) {
	var procedureID = req.query.procID;
	db.selectProcedure(procedureID, function(result){
		var fullUrl = req.protocol + '://' + req.get('host') + req.originalUrl;
		if(!req.session.username){res.render('login', {fullUrl : fullUrl})}else{
			res.render('procedure', {
				proc: result
			});
		}
	});
});



module.exports = router;