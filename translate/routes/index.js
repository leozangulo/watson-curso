var express = require('express');
var router = express.Router();
var LanguageTranslatorV2 = require('watson-developer-cloud/language-translator/v2');

/* GET home page. */
router.get('/', function(req, res, next) {
var languageTranslator = new LanguageTranslatorV2({
  username: '5c190533-a77e-4e5f-b207-5d2a2b3ed12a',
  password: 'NGcLTemQXo86',
  version: 'v2'
});
var parameters = {
  text: '¿saben que en 2010 TelMex pagó 6.5%; Televisa, 5.4%; y WalMart, 2.1% de impuestos?',
  model_id: 'es-en'
};

languageTranslator.translate(
  parameters,
  function(error, response) {
    if (error)
      console.log(error)
    else
      console.log(JSON.stringify(response, null, 2));
  })
});

module.exports = router;
