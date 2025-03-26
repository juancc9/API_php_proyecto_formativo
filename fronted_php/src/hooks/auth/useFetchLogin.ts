import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { toast } from "react-toastify";

export const useLogin = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({ email: "", password: "" });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await fetch("http://localhost/agrosoft_mvc/auth", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      });

      const data = await response.json();

      if (!response.ok || !data.token) { // 👈 Verifica que haya un token válido
        toast.error(data.message || "Credenciales incorrectas");
        return;
      }

      localStorage.setItem("token", data.token); // 👈 Guarda el token correctamente
      toast.success("Inicio de sesión exitoso");
      navigate("/inicio");
    } catch (error) {
      toast.error("Error en el inicio de sesión");
    }
  };

  return { formData, handleChange, handleSubmit };
};
