var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var session = require('express-session');

var fs = require('fs');

var routes = require('./routes/index');
var users = require('./routes/users');
var selectCountries = require('./routes/selectCountries');
var progressTask = require('./routes/progressTask');
var procedure = require('./routes/procedure');
var tasks = require('./routes/tasks');
var selectTask = require('./routes/selectTask');
var login = require('./routes/login');
var startSession = require('./routes/startSession');
var endSession = require('./routes/endSession');
var access_denied = require('./routes/access_denied');
var app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// uncomment after placing your favicon in /public
app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(session({secret:"abc", resave: false, saveUninitialized: true}))
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.static(path.join(__dirname, 'queries')));


app.use('/', routes);
app.use('/users', users);
app.use('/selectCountries', selectCountries);
app.use('/progressTask', progressTask);
app.use('/tasks', tasks);
app.use('/procedure', procedure);
app.use('/selectTask', selectTask);
app.use('/login', login);
app.use('/startSession', startSession);
app.use('/endSession', endSession);
app.use('/access_denied', access_denied);

// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

// error handlers

// development error handler
// will print stacktrace
if (app.get('env') === 'development') {
  app.use(function(err, req, res, next) {
    res.status(err.status || 500);
    res.render('error', {
      message: err.message,
      error: err
    });
  });
}




 // fs.readdirSync(__dirname + '/queries').forEach(function(filename) {
 //   if (~filename.indexOf('.js')) require(__dirname + '/queries/' + filename)
 // });

// production error handler
// no stacktraces leaked to user
app.use(function(err, req, res, next) {
  res.status(err.status || 500);
  res.render('error', {
    message: err.message,
    error: {}
  });
});


module.exports = app;
