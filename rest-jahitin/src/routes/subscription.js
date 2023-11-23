const express = require('express');
// const middlewareAuth = require('../middleware/authValidation');
const subscriptionController = require('../controller/subscription');

const router = express.Router();

// GET ALL - GET
router.get('/get', subscriptionController.getAllSubscriptionController);
router.patch('/acc/:id', subscriptionController.acceptSubscriptionController);

module.exports = router;

