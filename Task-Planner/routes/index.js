var express = require('express');
var router = express.Router();
var http = require('http').Server(router);
var io = require('socket.io')(http);

var db = require('../queries/queries.js');
var jq = require('../queries/jq.js');


router.get('/', function(req, res, next) {
	db.countryList(function(result){				
		res.render('index', { countries: result });
	});
});


io.on('connection', function(socket){
  console.log('a user connected');
});

module.exports = router;

