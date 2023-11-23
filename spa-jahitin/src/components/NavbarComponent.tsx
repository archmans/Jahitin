import React from 'react';
import { Navbar, Container, Nav } from 'react-bootstrap';
import { PersonCircle, HouseDoor, BoxArrowInRight } from 'react-bootstrap-icons';
import { Link } from 'react-router-dom';
import LogoutModal from './LogoutModal';

const NavbarComponent: React.FC = () => {
    const [modalshow, setmodalshow] = React.useState(false);

    // Misalnya, fungsi ini digunakan untuk menentukan peran pengguna (admin atau user)
    const getUserRole = () => {
        // Logika untuk mendapatkan peran pengguna
        // ...
        return 'admin'; // Gantilah dengan logika yang sesuai
    };

    const getHouseIconLink = () => {
        const userRole = getUserRole();
        return userRole === 'admin' ? '/subscription' : '/manage';
    };

    return (
        <div>
            <Navbar expand="lg" style={{ backgroundColor: '#121212' }}>
                <Container>
                    <Navbar.Brand href="#home">
                        <img
                            src="/logo_premium.png"
                            height="80"
                            className="d-inline-block align-top"
                            alt="logo jahitin"
                        />
                    </Navbar.Brand>
                    <Navbar.Toggle
                        className="border border-white border-3"
                        aria-controls="basic-navbar-nav"
                    />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="d-flex flex-row align-items-center ms-auto">
                            <Link to={getHouseIconLink()}>
                                <HouseDoor className="btn text-white me-2" size={65} />
                            </Link>
                            <Link to="/profil">
                                <PersonCircle className="btn text-white me-3" size={65} />
                            </Link>
                            <Container className="d-flex flex-column px-0">
                                <Navbar.Text className="text-white fw-bold fs-6 py-0">
                                    hi, Tifa!
                                </Navbar.Text>
                                <Navbar.Text className="text-white py-0">Admin</Navbar.Text>
                            </Container>
                            <BoxArrowInRight
                                className="btn text-danger"
                                size={100}
                                onClick={() => setmodalshow(true)}
                            />
                            <LogoutModal show={modalshow} onHide={() => setmodalshow(false)} />
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
        </div>
    );
};

export default NavbarComponent;
