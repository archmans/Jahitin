const express = require('express');

const tailorController = require('../controller/tailor');

const router = express.Router();

// GET
router.get('/', tailorController.getAllTailorsController);

module.exports = router;