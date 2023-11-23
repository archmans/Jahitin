import React from "react";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import axios from "axios";

interface ModalsProps {
    show: boolean;
    onHide: () => void;
    imageid: string;
}

const DeleteModal: React.FC<ModalsProps> = (props) => {
    const handleDelete = async () => {
        try {
            await axios.delete(`http://localhost:4000/manage/${props.imageid}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                }
            });
            props.onHide();
            window.location.reload();
        } catch (error) {
            console.error("Error deleting image: ", error);
        }
    };

    const handleCancel = () => {
        props.onHide();
    };

    return (
    <Modal
        {...props}
        size="lg"
        aria-labelledby="contained-modal-title-vcenter"
        centered
    >
        <Modal.Header className="d-flex flex-row justify-content-center align-items-center">
            <Modal.Title id="contained-modal-title-vcenter">
                Delete Image
            </Modal.Title>
        </Modal.Header>
        <Modal.Body className="d-flex flex-column justify-content-center align-items-center">
            <p>Are you sure you want to delete this image?</p>
            <p>This action cannot be undone.</p>
        </Modal.Body>
        <Modal.Footer>
            <Button variant="secondary" onClick={handleCancel}>
                Cancel
            </Button>
            <Button variant="danger" onClick={handleDelete}>
                Delete
            </Button>
        </Modal.Footer>
    </Modal>
    );
};

export default DeleteModal;
