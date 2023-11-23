import React from 'react';
import { Container } from 'react-bootstrap';
import { PersonCircle } from 'react-bootstrap-icons';

const ProfilePage: React.FC = () => {
    // Gantilah dengan logika atau state yang sesuai untuk menampilkan informasi profil
    const userProfile = {
        Username: 'John Doe',
        email: 'john.doe@example.com',
        // tambahkan informasi profil lainnya
    };

    return (
        <Container className="d-flex flex-column justify-content-center align-items-center mt-5 text-white">
            <h1 className="py-3 fw-bold text-white">Profile</h1>
            <Container className="d-flex flex-column align-items-center justify-content-center border border-white border-3 p-5 rounded-4" style={{width:'auto'}}>
                <Container className="d-flex flex-row align-items-center justify-content-center">
                    <PersonCircle className="me-3" size={100} />
                    <Container className="d-flex flex-column align-items-start justify-content-center">
                        <h3 className="fw-bold">{userProfile.Username}</h3>
                        <h6 className="fw-normal">{userProfile.email}</h6>
                      </Container>
                </Container>
            </Container>
        </Container>
    );
};

export default ProfilePage;
