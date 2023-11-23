const express = require('express');
const upload = require('../middleware/multer');

const manageController = require('../controller/manage');
const middlewareAuth = require('../middleware/authValidation');

const router = express.Router();

// READ - GET
router.get('/:idUser', middlewareAuth, manageController.readDataManageController);

// CREATE - POST
router.post('/:idUser', middlewareAuth, upload.single('image'), manageController.createDataManageController);

// UPDATE - PATCH
router.patch('/:idImage', middlewareAuth, upload.single('image'), manageController.updateDataManageController);

// READ - GET - UPDATE
router.get('/edit/:idImage', middlewareAuth, manageController.getUpdateDataManageController);

// DELETE - DELETE
router.delete('/:idImage', middlewareAuth, manageController.deleteDataManageController);

module.exports = router;