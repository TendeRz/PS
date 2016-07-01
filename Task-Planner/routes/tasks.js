var express = require('express');
var router = express.Router();

var db = require('../queries/queries.js');

router.get('/', progresState, rendering);



function progresState (req, res, next){
	db.selectProgressState(function(progressState){
		req.progstate = progressState;
		return next();
	})
}

function rendering(req, res){
	var tasklistid = req.query.tasklistid;
	res.render('tasks', {tasklistid: tasklistid,
						progstate: req.progstate});
}

module.exports = router;