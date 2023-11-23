const multer = require('multer');

const multerStorage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, 'public/images');
    },
    filename: (req, file, cb) => {
        const timestamp = new Date().getTime();
        const originalName = file.originalname;

        cb(null, `${timestamp}-${originalName}`);
    }
});

const upload = multer({
    storage: multerStorage,
    limits: {
        fileSize: 5 * 1024 * 1024 // 5MB
    },
});

module.exports = upload;