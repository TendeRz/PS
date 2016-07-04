var express = require('express');
var router = express.Router();

/* GET users listing. */
router.get('/', function(req, res, next) {
	req.session.username = '';
	res.send("Done");
});

module.exports = router;