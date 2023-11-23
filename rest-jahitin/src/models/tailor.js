const dbPool = require('../config/database');

const getAllTailorsModel = async () => {
    try {
        const connection = await dbPool.getConnection();
        const query = `SELECT id, username, imageID, imageName, imageNameExt FROM users NATURAL LEFT JOIN gallery WHERE gallery.idUser = users.id;`;
        const [rows] = await connection.query(query);
        connection.release();
        console.log(rows);
        return rows;
    } catch (err) {
        throw err;
    }
}

module.exports = {
    getAllTailorsModel
}