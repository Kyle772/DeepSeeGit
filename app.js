var express = require('express');
var session = require('express-session');
var flash = require('express-flash');
var compression = require('compression');

var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var sendgrid = require('@sendgrid/mail');

var app = express();
var sessionStore = new session.MemoryStore;

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// static path setup
app.use(express.static(path.join(__dirname, 'public')));
app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));

// other stuff
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser('secret'));
app.use(session({
    cookie: { maxAge: 60000 },
    store: sessionStore,
    saveUninitialized: true,
    resave: 'true',
    secret: 'secret'
}));
app.use(flash());
app.use(compression());

// data files
var persons = require('./data/persons');

app.get('/', function(req, res) {
    res.render('index', { 
        flashMsg: req.flash('flashMsg'),
        team: persons.team,
        advisors: persons.advisors
    });
});

// setup email/sendgrid
sendgrid.setApiKey(process.env.SENDGRID_API_KEY);
var contact_email = process.env.CONTACT_EMAIL;

// handle a signup submission
app.post('/signup', function(req, res) {

    var flashMsg = "";
    console.log("LOG:" + req.body.email);
    // make sure email is populated
    if(! req.body.email) {
       flashMsg = 'Please enter an email address.';
       req.flash('flashMsg', flashMsg);
       res.redirect(301, '/');
       return;
    } 
      
    // create the email message  
    const message = {
        to: contact_email,
        from: req.body.email,
        subject: 'Subscription request for DeepSee.io',
        text: req.body.email
    }

    // send the message and flash the result
    sendgrid.send(message)
    .then(function(result) {
        flashMsg = 'You have been successfully subscribed.';    
    }).catch(function(error) {
        flashMsg = 'Subscription failed.  Please email '+ contact_email +' directly.';
    }).then(() => {
        req.flash('flashMsg', flashMsg);
        res.redirect(301, '/');
    });

});

// handle a contact submission
app.post('/contact', function (req, res) {

    var flashMsg = "";

    // make sure email and message are populated
    if(! req.body.email) {
        flashMsg = 'Please enter an email address.';
        req.flash('flashMsg', flashMsg);
        res.redirect(301, '/');
        return;
    } 

    if(! req.body.message) {
        flashMsg = 'Please enter a valid message.';
        req.flash('flashMsg', flashMsg);
        res.redirect(301, '/');
        return;
    } 

    // create the email message
    const message = { 
        to: contact_email,
        from: req.body.email,
        subject: 'Contact message for DeepSee.io',
        text: 'Message from ' + req.body.email + ':\n\n' + req.body.message
    }

    // send the message and flash the result
    sendgrid.send(message)
    .then(function(result) {
        flashMsg = 'Message sent.  We will respond to you shortly!';    
    }).catch(function(error) {
        flashMsg = 'Message not sent.  Please email '+ contact_email +' directly.';
    }).then(() => {
        req.flash('flashMsg', flashMsg);
        res.redirect(301, '/');
    });
});

// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
  next();
});

module.exports = app;
