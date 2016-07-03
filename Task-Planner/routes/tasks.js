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
	var fullUrl = req.protocol + '://' + req.get('host') + req.originalUrl;
	if(!req.session.username){res.render('login', {fullUrl : fullUrl})}else{
	res.render('tasks', {tasklistid: tasklistid,
						progstate: req.progstate,
						user: req.session.username});
	}
}

module.exports = router;