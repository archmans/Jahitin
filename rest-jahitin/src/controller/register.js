const registerModels = require('../models/register')
const bcrypt = require('bcrypt');

const register = async (req, res) => {
    const {body} = req;
    try {
        const salt = bcrypt.genSaltSync(10);
        const hashedPassword = bcrypt.hashSync(body.password, salt);
        body.password = hashedPassword;
        await registerModels.register(body);
        res.status(201).json({
            message: 'CREATE new user success',
            data: body
        })
    } catch (error) {
        console.error('Error during user registration:', error);
        res.status(500).json({
            message: 'Server error',
            serverMessage: error.message
        })
    }
}

module.exports = {
    register
}