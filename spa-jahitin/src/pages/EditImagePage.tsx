import React, { useState, useEffect } from 'react';
import { Container, Form, Button, Image } from 'react-bootstrap';
import { Link, useParams } from 'react-router-dom';
import axios from 'axios';

const EditImage: React.FC = () => {
  const [newImage, setNewImage] = useState<File | null>(null);
  const [newImageName, setNewImageName] = useState<string>('');
  const [rowData, setData] = useState<{ imageID: string; imageName: string; imageNameExt: string; } | undefined>(undefined);

  const { imageID } = useParams<{ imageID: string }>();

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(`http://localhost:4000/manage/edit/${imageID}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        setData(response.data.data.data[0]);
      } catch (error) {
        console.error("Error fetching image data: ", error);
      }
    };

    fetchData();
  }, [imageID]);



  const existingImageName = rowData?.imageName;
  const imageNameExt = rowData?.imageNameExt;
  const existingImagePath = existingImageName && imageNameExt ? `http://localhost:4000/${imageNameExt}` : '';

  const handleNewImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files.length > 0) {
      const selectedImage = e.target.files[0];
      setNewImage(selectedImage);
    }
  };

  const handleNewImageNameChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setNewImageName(e.target.value);
  };

  const handleDone = async () => {
    try {
      const formData = new FormData();
      if (newImage || newImageName) {
        if (newImage) {
          formData.append('image', newImage as File);
        }
        if (newImageName) {
          formData.append('imageName', newImageName);
        }
        const response = await axios.patch(`http://localhost:4000/manage/${imageID}`, formData, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        });
        if (response.status === 200) {
          setNewImage(null);
          setNewImageName('');
          window.location.href = '/manage';
        }
      }

    } catch (error) {
      console.error("Error adding image: ", error);
    }
  };

  const handleCancel = () => {
    // kembali ke halaman manage karya dengan SPA

  };

  return (
    <Container className="ms-auto d-flex flex-column justify-content-center align-items-center">
        <h1 className='py-5 fw-bold text-white'>Edit Image</h1>
        <Form>
            <div className='d-flex flex-column justify-content-center align-items-center'>
              <Form.Group controlId="formExistingImage">
                  <Image src={existingImagePath} alt={existingImageName} fluid style={{ maxWidth: '300px' }} />
              </Form.Group>

              <Form.Group controlId="formExistingImageName">
                  <Form.Label className='text-white'>{existingImageName}</Form.Label>
              </Form.Group>
            </div>

            <Form.Group controlId="formNewImageName">
              <Form.Label className='text-white'>New Image Name</Form.Label>
              <Form.Control type="text" value={newImageName} onChange={handleNewImageNameChange} />
            </Form.Group>

            <Form.Group className='mt-4' controlId="formNewImage">
              <Form.Label className='text-white'>New Image</Form.Label>
              <Form.Control type="file" onChange={handleNewImageChange} accept="image/*" />
            </Form.Group>
            
            <div className='d-flex justify-content-center'>
                <Link to='/manage'>
                    <Button 
                        className='mt-5 me-3 border border-white bg-transparent'
                        onClick={handleCancel}
                        style={{ transition: 'color 0.3s ease' }}
                        onMouseOver={(e) => {
                            e.currentTarget.style.color = '#dc3545'; // Ganti dengan warna teks yang diinginkan
                        }}
                        onMouseOut={(e) => {
                            e.currentTarget.style.color = '#fff'; // Ganti dengan warna teks default
                        }}>
                        Cancel
                    </Button>
                </Link>
              <Button className='mt-5 ms-3' variant="success" onClick={handleDone}>
                Done
              </Button>
            </div>
        </Form>
    </Container>
  );
};

export default EditImage;
