const tailorModel = require('../models/tailor')

const getAllTailorsController = async (req, res) => {
    try {
        const tailors = await tailorModel.getAllTailorsModel()
        res.status(200).json({
            message: 'Success get all tailors',
            data: tailors
        })
    } catch {
        res.status(500).json({
            message: 'Server error'
        })
    }
}

module.exports = {
    getAllTailorsController
}