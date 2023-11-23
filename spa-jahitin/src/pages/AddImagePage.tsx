import React, { useState } from 'react';
import { Container, Form, Button } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import axios from 'axios';

const AddImagePage: React.FC = () => {
  const [image, setImage] = useState<File | null>(null);
  const [imageName, setImageName] = useState<string>('');

  const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files.length > 0) {
      const selectedImage = e.target.files[0];
      setImage(selectedImage);
    }
  };

  const handleImageNameChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setImageName(e.target.value);
  };

  const handleAddImage = async () => {
    const idUser = localStorage.getItem('idUser');
    try {
      const formData = new FormData();
      formData.append('image', image as File);
      formData.append('imageName', imageName);
      const response = await axios.post(`http://localhost:4000/manage/${idUser}`, formData, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        }
      });
      if (response.status === 201) {
        setImage(null);
        setImageName('');
        window.location.href = '/manage';
      }
    } catch (error) {
      console.error('Error Add Image:', error);
    }
  };

  const handleCancel = () => {
    // kembali ke halaman manage karya dengan SPA
  };

  return (
    <Container className="ms-auto d-flex flex-column justify-content-center align-items-center">
        <h1 className='py-5 fw-bold text-white'>Add Image</h1>
        <Form>
            <Form.Group controlId="formImageName">
            <Form.Label className='text-white'>Image Name</Form.Label>
            <Form.Control type="text" value={imageName} onChange={handleImageNameChange} />
            </Form.Group>

            <Form.Group className='mt-4' controlId="formImage">
            <Form.Label className='text-white'>Image</Form.Label>
            <Form.Control type="file" onChange={handleImageChange} accept="image/*" />
            </Form.Group>
            
            <div className='d-flex justify-content-center'>
                <Link to='/manage'>
                    <Button 
                        className='mt-5 me-3 border border-white bg-transparent'
                        onClick={handleCancel}
                        style={{ transition: 'color 0.3s ease' }}
                        onMouseOver={(e) => {
                            e.currentTarget.style.color = '#dc3545';
                        }}
                        onMouseOut={(e) => {
                            e.currentTarget.style.color = '#fff';
                        }}>
                        Cancel
                    </Button>
                </Link>
                <Button className='mt-5 ms-3' variant="success" onClick={handleAddImage}>Add Image</Button>
            </div>
        </Form>
    </Container>
  );
};

export default AddImagePage;
