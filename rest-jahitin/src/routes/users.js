const express = require('express');

const usersController = require('../controller/users');

const router = express.Router();

// CREATE - POST
router.post('/', usersController.createNewUser);

// READ - GET
router.get('/', usersController.getAllUsers);

// UPDATE - PATCH
router.patch('/:idUser', usersController.updateUser);

// DELETE - DELETE
router.delete('/:idUser', usersController.deleteUser);

module.exports = router;