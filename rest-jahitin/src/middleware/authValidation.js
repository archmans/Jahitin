const jwt = require('jsonwebtoken')

const authValidation = (req, res, next) => {
    const {authorization} = req.headers;
    if (!authorization) {
        return res.status(401).json({
            message: 'Please login first'
        })
    }
    try {
        const token = authorization.split(' ')[1];
        const decoded = jwt.verify(token, process.env.JWT_SECRET);
        req.user = decoded;
        next();
    } catch (error) {
        res.status(401).json({
            message: 'Invalid token'
        })
    }
}

module.exports = authValidation;