require('dotenv').config();
const dbPool = require('../config/database');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

const login = async (body) => {
    let connection; // Declare connection variable at a higher scope

    try {
        connection = await dbPool.getConnection();
        const query = `SELECT * FROM users WHERE username = '${body.username}'`;
        const [rows] = await connection.query(query);
        
        if (rows.length === 0) {
            return { token: null, idUser: null }; // Return an object with null token and idUser
        }

        const user = rows[0];
        const isPasswordValid = await bcrypt.compare(body.password, user.password);

        if (!isPasswordValid) {
            return { token: null, idUser: null }; // Return an object with null token and idUser
        }
        
        const idUser = user.id;
        const token = jwt.sign({ id: user.id }, process.env.JWT_SECRET, { expiresIn: '1h' });
        return { token, idUser };
    } catch (err) {
        console.error('Error during user login:', err);
        return { token: null, idUser: null }; // Return an object with null token and idUser
    } finally {
        console.log('login model finally');
        if (connection) {
            connection.release();
        }
    }
};

module.exports = {
    login,
};
