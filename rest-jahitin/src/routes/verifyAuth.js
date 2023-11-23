const express = require('express');
const jwt = require('jsonwebtoken');
const router = express.Router();
const secretKey = process.env.JWT_SECRET;

router.get('/', async (req, res) => {
  const token = req.headers['authorization'];

  if (!token) {
    return res.status(401).json({ message: 'Access denied. Token is missing.' });
  }

  try {
    const decoded = jwt.verify(token, secretKey);
    req.user = decoded;

    res.status(200).json({ message: 'Token is valid.' });
  } catch (error) {
    res.status(401).json({ message: 'Invalid token.' });
  }
});

module.exports = router;
