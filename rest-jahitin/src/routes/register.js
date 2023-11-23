const express = require('express');

const registerController = require('../controller/register');

const router = express.Router();

// CREATE - POST
router.post('/', registerController.register);

module.exports = router;