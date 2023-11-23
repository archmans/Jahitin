import axios from 'axios';

const verifyToken = async (token: string | null): Promise<boolean> => {
try {
    if (token) {
    await axios.get('http://localhost:4000/verify', {
        headers: {
        Authorization: token,
        },
    });

    return true;
    }
    return false;
} catch (error) {
    console.error('Error verifying token:', error);
    return false;
}
};

export default verifyToken;
