var express = require('express');
var router = express.Router();

var db = require('../queries/queries.js');

router.get('/', function(req, res, next) {
	var procedureID = req.query.procID;
	db.selectProcedure(procedureID, function(result){
		console.log(result);
		res.render('procedure', {
			proc: result
		});
	});
});



module.exports = router;