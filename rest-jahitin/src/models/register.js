const dbPool = require('../config/database');
const register = (body) => {
    const query = `INSERT INTO users (username, email, password)
                    VALUES ('${body.username}', '${body.email}', '${body.password}')`;
    return dbPool.execute(query);
}
module.exports = {
    register
}
