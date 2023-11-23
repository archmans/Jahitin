import React, { useState, useEffect }  from 'react';
import { Routes, Route, useLocation, Navigate} from 'react-router-dom';
import NavbarComponent from './components/NavbarComponent';
import SubsManagePage from './pages/SubsManagePage';
import ProfilPage from './pages/ProfilPage';
import LoginPage from './pages/LoginPage';
import RegisterPage from './pages/RegisterPage';
import AddImagePage from './pages/AddImagePage';
import EditImagePage from './pages/EditImagePage';
import GalleryManagePage from './pages/GalleryManagePage';
import verifyToken from './utils/verifyToken';

const App: React.FC = () => {
  const location = useLocation();
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [loading, setLoading] = useState(true);
  const isNavbarVisible = location.pathname !== '/login' && location.pathname !== '/register';

  useEffect(() => {
    const getTokenAndVerify = async () => {
      const token = localStorage.getItem('token');

      const isValid = await verifyToken(token);

      setIsAuthenticated(isValid);
      setLoading(false);
    };

    getTokenAndVerify();
  }, []);

  if (loading) {
    return <div>Loading...</div>;
  }

  if (!isAuthenticated && location.pathname !== '/login' && location.pathname !== '/register') {
    return <Navigate to="/login" />;
  }


  return (
    <div>
      {isNavbarVisible && <NavbarComponent />}
      <Routes>
        <Route path="/subscription" element={<SubsManagePage />} />
        <Route path="/profil" element={<ProfilPage />} />
        <Route path="/login" element={<LoginPage />} />
        <Route path="/register" element={<RegisterPage />} />
        <Route path="/add" element={<AddImagePage />} />
        <Route path="/edit/:imageID" element={<EditImagePage />} />
        <Route path="/manage" element={<GalleryManagePage />} />
      </Routes> 
    </div>
  );
}

export default App;
