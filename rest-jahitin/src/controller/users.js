const userModel = require('../models/users')

const getAllUsers = async (req, res) => {
    try {
        const [data] = await userModel.getAllUsers();
        res.json({
            message: 'GET all users success',
            data: data
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}


const createNewUser = async (req, res) => {
    console.log(req.body);
    const {body} = req;
    if(!body.name || !body.email || !body.address) {
        res.status(400).json({
            message: 'Please fill all required field',
            data: null
        })
    }
    try {
        await userModel.createNewUser(body);
        res.status(201).json({
            message: 'CREATE new user success',
            data: body
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}

const updateUser = async (req, res) => {
    const { idUser } = req.params;
    const { body } = req;
    try {
        await userModel.updateUser(idUser, body);
        res.json({
            message: 'UPDATE user success',
            data: {
                idUser: idUser,
                ...body
            }
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}

const deleteUser = async (req, res) => {
    const { idUser } = req.params;
    try {
        await userModel.deleteUser(idUser);
        res.json({
            message: 'DELETE user success',
            data: null
        })
    }
    catch (error) {
        res.status(500).json({
            message: 'Server error',
            serverMessage: error,
        })
    }
}

module.exports = {
    getAllUsers,
    createNewUser,
    updateUser,
    deleteUser
}