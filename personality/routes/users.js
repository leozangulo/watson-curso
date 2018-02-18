var express = require('express');
var router = express.Router();
var PersonalityInsightsV3 = require('watson-developer-cloud/personality-insights/v3');



/* GET users listing. */
router.get('/', function(req, res, next) {

  var personality_insights = new PersonalityInsightsV3({
	  username: '0236bfdc-f86b-461d-b513-9e40b50c4b91',
	  password: 'kqQu6plXXsb6',
	  version_date: '2017-10-13'
	});

	var params = {
	  // Get the content from the JSON file.
	  content: require('/opt/lampp/htdocs/personality/public/profile.json'),
	  content_type: 'application/json',
	  content_language: 'en',
	  consumption_preferences: true,
	  raw_scores: true
	};

	personality_insights.profile(params, function(error, response) {
	  if (error)
	    console.log('Error:', error);
	  else
	    console.log(JSON.stringify(response, null, 2));
	  }
	);
});

module.exports = router;
