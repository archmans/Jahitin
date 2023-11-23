const express = require('express');

const loginController = require('../controller/login');

const router = express.Router();

// CREATE - POST
router.post('/', loginController.loginController);

module.exports = router;