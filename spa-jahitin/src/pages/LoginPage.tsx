import React, { useState } from 'react';
import { Container, Form, Button } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import axios, { AxiosResponse } from 'axios';

const LoginPage: React.FC = () => {
const [username, setUsername] = useState<string>('');
const [password, setPassword] = useState<string>('');

const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
        const response: AxiosResponse<{ token: string, idUser:string }> = await axios.post<{ token: string, idUser:string }>('http://localhost:4000/login', {
            username,
            password,
        });
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('idUser', response.data.idUser);
        if (response.data.token) {
            window.location.href = '/subscription';
        }
    } catch (error) {
        console.error("Error login: ", error);
    }
};

return (
    <Container fluid className="ms-auto d-flex justify-content-center align-items-center" style={{ minHeight: '100vh' }}>
        <Container className="d-flex flex-column justify-content-center rounded-4 shadow" style={{ height: '550px', width: '450px', backgroundColor: '#121212' }}>
            <Container className="d-flex flex-column align-items-center">
                <img
                    src="/logo_premium.png"
                    height="120"
                    className="d-inline-block mb-4"
                    alt="logo jahitin"
                />
                <h1 className="text-white mb-5 font-weight-bolder">Login</h1>
                <Form className="d-flex flex-column align-items-center" onSubmit={handleLogin} style={{ width: '100%' }}>
                    <Form.Group className="mb-4 px-5" controlId="formBasicUsername" style={{ width: '100%' }}>
                    <Form.Control
                        className="rounded-5 px-4 py-2 border-2"
                        type="username"
                        placeholder="Username"
                        value={username}
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setUsername(e.target.value)}
                    />
                    </Form.Group>

                    <Form.Group className="mb-3 px-5" controlId="formBasicPassword" style={{ width: '100%' }}>
                    <Form.Control
                        className="rounded-5 px-4 py-2 border-2"
                        type="password"
                        placeholder="Password"
                        value={password}
                        onChange={(e: React.ChangeEvent<HTMLInputElement>) => setPassword(e.target.value)}
                    />
                    </Form.Group>

                    <Button
                        className="mt-4 py-2 px-5 rounded-5"
                        variant="primary"
                        type="submit"
                        style={{
                            background: '#279864',
                            color: '#fff',
                            border: 'none',
                            outline: 'none',
                            fontWeight: 'bold',
                            transition: 'transform 0.3s ease',
                        }}
                        onMouseOver={(e) => {
                        e.currentTarget.style.transform = 'scale(1.05)';
                        }}
                        onMouseOut={(e) => {
                        e.currentTarget.style.transform = 'scale(1)';
                        }}
                    >
                        Login
                    </Button>

                    <p className="mt-3 text-white">
                        Don't Have an Account?{' '}
                        <Link
                            to="/register"
                            style={{
                            color: '#279864',
                            textDecoration: 'none',
                            fontWeight: 'bold',
                            transition: 'transform 0.3s ease', 
                            display: 'inline-block',
                            }}
                            onMouseOver={(e) => {
                            e.currentTarget.style.transform = 'scale(1.05)';
                            }}
                            onMouseOut={(e) => {
                            e.currentTarget.style.transform = 'scale(1)'; 
                            }}>
                            Register Here
                        </Link>
                    </p>
                </Form>
            </Container>
        </Container>
    </Container>
);
};

export default LoginPage;
