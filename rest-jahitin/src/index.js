const PORT = 4000;
const express = require('express');
const cors = require('cors');

const usersRoutes = require('./routes/users');
const registerRoutes = require('./routes/register');
const loginRoutes = require('./routes/login');
const manageRoutes = require('./routes/manage');
const verifyRoutes = require('./routes/verifyAuth');
const logoutRoutes = require('./routes/logout');
const subscriptionRoutes = require('./routes/subscription');
const tailorRoutes = require('./routes/tailor');

const middlewareLogRequest = require('./middleware/logs');
const middlewareAuth = require('./middleware/authValidation');

const app = express();
app.use(cors());
app.use(middlewareLogRequest);
app.use(express.json());
app.use(express.static('public/images'));
app.use("/verify", verifyRoutes);
app.use("/users", usersRoutes);
app.use("/register", registerRoutes);
app.use("/login", loginRoutes);
app.use("/manage", manageRoutes);
app.use("/logout", middlewareAuth, logoutRoutes);
app.use("/subscription", subscriptionRoutes);
app.use("/tailor", tailorRoutes);

app.use((err, req, res, next) => {
    res.json({
        message: err.message
    })
});

app.listen(PORT, () => {
    console.log(`Server listening on port ${PORT}`);
});