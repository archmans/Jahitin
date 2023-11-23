const manageModel = require('../models/manage')

const readDataManageController = async (req, res) => {
    const { idUser } = req.params;
    try {
        const [data] = await manageModel.readData(idUser);
        res.json({
            message: 'GET all gallery success',
            data: {
                idUser: idUser,
                data: data
            }
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}

const createDataManageController = async (req, res) => {
    const { idUser } = req.params;
    try {
        const imageName = req.body.imageName;
        const imagePath = req.file.filename;
    
        await manageModel.createData({
            imageName: imageName,
            imageNameExt: imagePath,
            idUser: idUser
        });
        res.status(201).json({
            message: 'CREATE new gallery success',
            data: {
            },
        });
    } catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}

const updateDataManageController = async (req, res) => {
    const { idImage } = req.params;
    try {
        const imageName = req.body.imageName;
        const imagePath = req.file.filename;
    
        await manageModel.updateData({
            imageName: imageName,
            imageNameExt: imagePath,
            idImage: idImage
        });
        res.status(200).json({
            message: 'UPDATE gallery success',
            data: {
            },
        });
    } catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}

const getUpdateDataManageController = async (req, res) => {
    const { idImage } = req.params;
    try {
        const [data] = await manageModel.getUpdateData(idImage);
        res.json({
            message: 'GET all update gallery success',
            data: {
                idImage: idImage,
                data: data
            }
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}

const deleteDataManageController = async (req, res) => {
    const { idImage } = req.params;
    try {
        await manageModel.deleteData(idImage);
        res.status(200).json({
            message: 'DELETE gallery success',
            data: {
            },
        });
    } catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}

module.exports = {
    readDataManageController,
    createDataManageController,
    updateDataManageController,
    getUpdateDataManageController,
    deleteDataManageController
}