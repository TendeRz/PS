var express = require('express');
var router = express.Router();
var db = require('../queries/queries.js');


router.get('/', function(req, res, next) {
	var newstate = req.query.newstate;
	var tasklistid = req.query.tasklistid;
	var taskid = req.query.taskid;
	var newstatus = req.query.newstatus;
	var description = req.query.description;
	var testDescription = req.query.testDescription;


	if (newstate == 'In Progress') {quickProgress(tasklistid, taskid);};
	if (newstate == 'Set Next State') {progressTask(tasklistid, taskid, newstatus, description);};
	if (newstate == 'Description Update') {descriptionUpdate(tasklistid, taskid, testDescription);};


	function quickProgress(tasklistid, taskid, callback){
		db.updateQProgress(tasklistid, taskid, function(result){
			res.send(result);
		})
	}

	function progressTask(tasklistid, taskid, newstatus, description, callback){
		db.updateProgress(tasklistid, taskid, newstatus, description, function(result){
			res.send(result);
		})
	}

	function descriptionUpdate(tasklistid, taskid, testDescription){
		db.updateDescription(tasklistid, taskid, testDescription, function(result){
			res.send(result);
		})
	}
});

	module.exports = router;
