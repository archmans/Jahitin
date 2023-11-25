const express = require('express');
// const middlewareAuth = require('../middleware/authValidation');
const subscriptionController = require('../controller/subscription');

const router = express.Router();

// GET ALL - GET
router.get('/get', subscriptionController.getAllSubscriptionController);
router.patch('/acc/:id', subscriptionController.acceptSubscriptionController);
router.patch('/rej/:id', subscriptionController.rejectSubscriptionController);

module.exports = router;

