import React from "react";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
import axios from "axios";

interface ModalsProps {
  show: boolean;
  onHide: () => void;
}

const DeleteModal: React.FC<ModalsProps> = (props) => {
  const handleLogout = async () => {
    try {
      const response = await axios.post(
        "http://localhost:4000/logout",
        {},
        {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        }
      );
      if (response.status === 200) {
        localStorage.removeItem("token");
        localStorage.removeItem("idUser");
        props.onHide();
        window.location.href = "/";
      }
    } catch (error) {
      console.error('Error:', error);
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
        <Modal.Title id="contained-modal-title-vcenter">Logout</Modal.Title>
      </Modal.Header>
      <Modal.Body className="d-flex flex-column justify-content-center align-items-center">
        <p>Are you sure you want to logout?</p>
      </Modal.Body>
      <Modal.Footer>
        <Button variant="secondary" onClick={handleCancel}>
          Cancel
        </Button>
        <Button variant="danger" onClick={handleLogout}>
          Logout
        </Button>
      </Modal.Footer>
    </Modal>
  );
};

export default DeleteModal;
