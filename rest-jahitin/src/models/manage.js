const dbPool = require('../config/database');

const readData = (idUser) => {
    const query = `SELECT * FROM gallery WHERE idUser = ${idUser}`;
    return dbPool.execute(query);
}

const createData = ({imageName, imageNameExt, idUser}) => {
    const query = `INSERT INTO gallery (imageName, imageNameExt, idUser) VALUES ('${imageName}', '${imageNameExt}', ${idUser})`;
    return dbPool.execute(query);
}

const getUpdateData = (idImage) => {
    const query = `SELECT * FROM gallery WHERE imageID = ${idImage}`;
    return dbPool.execute(query);
}

const updateData = ({imageName, imageNameExt, idImage}) => {
    const query = `UPDATE gallery SET imageName = '${imageName}', imageNameExt = '${imageNameExt}' WHERE imageID = ${idImage}`;
    return dbPool.execute(query);
}

const deleteData = (idImage) => {
    const query = `DELETE FROM gallery WHERE imageID = ${idImage}`;
    return dbPool.execute(query);
}

module.exports = {
    readData,
    createData,
    updateData,
    getUpdateData,
    deleteData
};