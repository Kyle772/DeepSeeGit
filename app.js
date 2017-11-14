// app server modules
var express = require('express');
var session = require('express-session');
var flash = require('express-flash');
var compression = require('compression');

var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');

// external apis
var sendgrid = require('@sendgrid/mail');
var request = require('request');
const sagent = require('superagent');

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

app.get('/ia', function(req, res) {
    res.render('ia', { 

    });
});

// setup email/sendgrid/mailchimp
sendgrid.setApiKey(process.env.SENDGRID_API_KEY);
var contact_email = process.env.CONTACT_EMAIL;
var mcApiKey = process.env.MAILCHIMP_API_KEY;
var mcInstance = process.env.MAILCHIMP_INSTANCE;
var mcListId = process.env.MAILCHIMP_SUBSCRIBER_LIST_ID;

// IA constants

const IA_API = 'https://dashboard.instantaccess.io';
const IA_CLIENT_ID = '13';
const IA_CLIENT_SECRET = 'Qtee7huqam5JAm4ZRmLivy3Lr6vUDbBtMfSU1Z8t';

// retrieves a user access token from IA given a IA code and user information 
// (state);

const getIaToken = (iaCode, iaState) => {

    return new Promise((resolve, reject) => {

        sagent
        .post(`${IA_API}/api/oauth/token?code=${iaCode}&state=${iaState}`)
        .send( {
            client_id: IA_CLIENT_ID,
            client_secret: IA_CLIENT_SECRET,
            code: iaCode,
            redirect_uri: "https://wfsaxton-deepsee.herokuapp.com/signup-ia",
            grant_type: 'authorization_code'
        })
        .set('accept', 'json')
        .end((error, res) => {
            if (error) {
                console.error("ERROR:getIaToken");
                console.error(error);
                reject(error);
            } else {
                resolve(res.body.access_token);
            }        
        })
    });
};

// retrieves user data from IA given a user access token

const getIaData = (iaToken) => {

    return new Promise((resolve, reject) => {

        sagent
        .get(`${IA_API}/api/public/user`)
        .set('Content-Type', 'application/json')
        .set('Authorization', `Bearer ${iaToken}`)
        .end((error, res) => {
            if (error) {
                console.error("ERROR: getIaData");
                console.error(error);
                reject(error);
            } else {
                resolve(res.body.data);
            }  
        });
    });
};

const subscribeEmail = (email) => {

    return new Promise((resolve, reject) => {

        // set up the mailchimp post options
        var options = { method: 'POST',
        url: 'https://'+ mcInstance +'.api.mailchimp.com/3.0/lists/'+ mcListId +'/members/',
        headers: 
        { 
            'postman-token': '35c708d5-55bc-f828-90b6-d8dc5e01c3dc',
            'cache-control': 'no-cache',
            authorization: 'Basic ' + mcApiKey,
            'content-type': 'application/json' },
            body: 
            { 
                email_address: email,
                status: 'subscribed' 
            },
            json: true 
        };

        request(options, function (error, response, body) {
            if (error) {
                reject(error);
            } else {
                resolve(true);
            }        
        });
    });
};

function getEmailFromIaData(iaData) {

    for(var i = 0; i < iaData.length; i++) {

        if(iaData[i].attribute.trim() === "Emails") {            
            return iaData[i].value;
        }
    }

    return "saxton+bademail@gmail.com";
}

// Instant Access callback

app.get('/signup-ia', function(req, res) {

    let iaCode = req.param('code');
    let iaState = req.param('state');
    
    console.log(`CODE: ${iaCode}, STATE: ${iaState}`);

    getIaToken(iaCode, iaState)
    .then(getIaData)
    .then((iaData) => {
        let email = getEmailFromIaData(iaData);
        return email;
    })
    .then(subscribeEmail)
    .catch((error) => {
        console.log(`SIGNUP-AI ERROR: ${error}`);
    });

    res.setHeader('Content-Type', 'application/json');
    res.send(JSON.stringify({ success: true }));
});

// handle a signup via IA redirection

app.get('/signup-ia-redirect', function(req, res) {

    req.flash('flashMsg', 'You have been successfully subscribed.');
    res.redirect(301, '/');
});

// handle a signup submission
app.post('/signup', function(req, res) {

    var flashMsg = "";

    // make sure email is populated
    if(! req.body.email) {
       flashMsg = 'Please enter an email address.';
       req.flash('flashMsg', flashMsg);
       res.redirect(301, '/');
       return;
    } 

    // set up the mailchimp post options
    var options = { method: 'POST',
    url: 'https://'+ mcInstance +'.api.mailchimp.com/3.0/lists/'+ mcListId +'/members/',
    headers: 
    { 
        'postman-token': '35c708d5-55bc-f828-90b6-d8dc5e01c3dc',
        'cache-control': 'no-cache',
        authorization: 'Basic ' + mcApiKey,
        'content-type': 'application/json' },
        body: 
        { 
            email_address: req.body.email,
            status: 'subscribed' 
        },
        json: true 
    };

    request(options, function (error, response, body) {
        if (error) {
            console.log(error);
            req.flash('flashMsg', 'Subscription failed.  Please email '+ contact_email +' for assistance.');
        } else {
            req.flash('flashMsg', 'You have been successfully subscribed.');
        }        
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
