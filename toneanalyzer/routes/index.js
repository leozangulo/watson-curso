var express = require('express');
var router = express.Router();
var ToneAnalyzerV3 = require('watson-developer-cloud/tone-analyzer/v3');

/* GET home page. */
router.get('/', function(req, res, next) {
	var tone_analyzer = new ToneAnalyzerV3({
	  username: '004be85a-8866-41aa-a80d-62e6118a53fb',
	  password: 'YufUIKBXWNMa',
	  version_date: '2017-09-21'
	});
	
	var params = {
	  'text': 'i hate you!!!!',
	  'content_type': 'text/plain'
	};

	tone_analyzer.tone(params, function(error, response) {
	  if (error)
	    console.log('error:', error);
	  else
	    console.log(JSON.stringify(response, null, 2));
	  })
});

module.exports = router;
