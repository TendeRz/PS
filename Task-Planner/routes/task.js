var express = require('express');
var router = express.Router();

/* GET full task view. */
router.get('/', function(req, res, next) {
	var tasklistid = req.query.taskid;
  res.render('task', { tasklistid : tasklistid });
});

module.exports = router;