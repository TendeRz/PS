var express = require('express');
var router = express.Router();
var db = require('../queries/queries.js');

/* GET full task view. */

router.get('/', tabldeData, tablehistory, rendering);
function tabldeData(req, res, next){
	var tasklistid = req.query.taskid;

	db.selectTask(tasklistid, function(data){
		var problem = data[0].createdate;
		var norpblem = new Date(problem).toISOString().replace(/T/, ' ').replace(/\..+/, '');
		req.tabledata = data;
		req.createdate = norpblem;
		return next();
	})
}

function tablehistory(req, res, next){
	var tasklistid = req.query.taskid;
	db.selectHistory(tasklistid, function(data){
		
		req.tablehistory = data;
		return next();
	})
}


function rendering(req, res){

	res.render('task', {
		task: req.tabledata,
		createdate: req.createdate,
		tablehistory: req.tablehistory
	});
}


module.exports = router;